<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\UserVerifyWay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Hanoivip\User\Mail\TwofaTurnOff;
use Hanoivip\User\Mail\TwofaTurnOn;
use Hanoivip\User\Mail\TwofaValueAdded;
use Hanoivip\User\Mail\TwofaValueRemoved;
use Hanoivip\User\Mail\TwofaRevokeDevices;
use Hanoivip\User\Mail\TwofaRevokeDevice;
use Hanoivip\User\Mail\TwofaNewDevice;
use Hanoivip\User\Mail\TwofaStrangeDevice;
use Hanoivip\User\Device;
use Exception;

class TwofaService
{
    // TODO: other apps
    const WAYS = ['email' => 1, 'code' => 1, 'authenticator' => 1];
    
    protected $devices;
    
    public function __construct(DeviceService $devices)
    {
        $this->devices = $devices;
    }
    
    // Is 2fa enabled?
    public function getStatus($userId)
    {
        $ways = $this->getUserWays($userId);
        return !empty($ways);
    }
    
    public function getDefaultWay()
    {
        return 'email';
    }
    
    public function getUserDevices($userId)
    {
        return $this->devices->getUserDevices($userId);
    }
    
    public function getUserActivities($userId)
    {
        return [];
    }
    
    public function getUserWays($userId)
    {
        $records = UserVerifyWay::where('user_id', $userId)
        ->where('verified', true)
        ->where('delete', false)->get();
        $ways = [];
        foreach ($records as $record)
        {
            $ways[$record->way] = $record;
        }
        return $ways;
    }
    
    public function getOtherWays($userWays)
    {
        $others = self::WAYS;
        foreach ($userWays as $way => $i)
        {
            unset($others[$way]);
        }
        return $others;
    }
    
    public function turnoff($userId)
    {
        // save
        UserVerifyWay::where('user_id', $userId)->update(['delete' => true]);
        // notifications
        $this->notifyUser($userId, new TwofaTurnOff());
        return true;
    }
    
    public function revokeDevices($userId)
    {
        $this->devices->revokeAllDevices($userId);
        $this->notifyUser($userId, new TwofaRevokeDevices());
    }
    
    public function revokeDevice($userId, $deviceId)
    {
        $this->devices->revokeUserDevice($userId, $deviceId);
        $this->notifyUser($userId, new TwofaRevokeDevice());
    }
    
    public function list($userId, $way)
    {
        return UserVerifyWay::where('user_id', $userId)
        ->where('way', $way)
        ->where('verified', true)
        ->where('delete', false)
        ->get();
    }
    /**
     * 
     * @param string $way
     * @throws Exception
     * @return IVerifier
     */
    protected function getVerifier($way)
    {
        switch ($way)
        {
            case 'email': return app()->make(EmailVerifier::class);
            case 'code': return app()->make(CodeVerifier::class);
            case 'authenticator': return app()->make(AuthenticatorVerifier::class);
            default:
                throw new Exception('Not supported verifier!');
        }
    }
    
    public function beginAdd($userId, $way)
    {
        $verifier = $this->getVerifier($way);
        return $verifier->init();
    }
    
    public function addValue($userId, $way, $value)
    {
        $verifier = $this->getVerifier($way);
        return $verifier->add($userId, $value);
    }
    
    public function removeValue($userId, $way, $value)
    {
        $verifier = $this->getVerifier($way);
        $verifier->remove($userId, $value);
        if ($this->getStatus($userId))
        {
            $this->notifyUser($userId, new TwofaValueRemoved($way, $value));
        }
        else
        {
            $this->notifyUser($userId, new TwofaTurnOff());
        }
        return true;
    }
    
    // validation by middleware
    public function validateValue($userId, $way, $value, $validator)
    {
        $status = $this->getStatus($userId);
        $verifier = $this->getVerifier($way);
        $result = $verifier->validate($userId, $value, $validator);
        Log::debug("test..." . print_r($result, true));
        if ($result == true)
        {
            UserVerifyWay::where('user_id', $userId)
            ->where('way', $way)
            ->where('value', $value)
            ->where('verified', false)
            ->where('delete', false)
            ->update(['verified' => true]);
            if (empty($status))
            {
                $this->notifyUser($userId, new TwofaTurnOn());
            }
            else
            {
                $this->notifyUser($userId, new TwofaValueAdded($way, $value));
            }
        }
        return $result;
    }
    
    public function needValidate($way)
    {
        $verifier = $this->getVerifier($way);
        return $verifier->needValidation();
    }
    
    public function notifyUser($userId, $template)
    {
        $ways = $this->getUserWays($userId);
        foreach ($ways as $way => $record)
        {
            if ($way == 'email')
            {
                Mail::to($record->value)->send($template);
            }
        }
    }
    
    public function needVerifyDevice($userId, $device)
    {
        return $this->devices->needVerifyDevice($userId, $device);
    }
    /**
     * 
     * @param number $userId
     * @param Device $device
     */
    public function startVerifyDevice($userId, $way, $device)
    {
        $record = $this->devices->getUserDevice($userId, $device->deviceId);
        if (!empty($record))
            return __('hanoivip::twofa.device.verified');
        $verifier = $this->getVerifier($way);
        return $verifier->startVerify($userId, $device->deviceId);
    }
    /**
     *
     * @param number $userId
     * @param Device $device
     */
    public function verify($userId, $device, $way, $otp)
    {
        $verifier = $this->getVerifier($way);
        $result = $verifier->verify($userId, $device->deviceId, $otp);
        if ($result === true)
        {
            $this->devices->trustDevice($userId, $device);
            // log
            $way = UserVerifyWay::where('user_id', $userId)
            ->where('way', $way)
            ->where('verified', true)
            ->where('delete', false)
            ->update(['use_count' => DB::raw('use_count + 1')]);
            $this->notifyUser($userId, new TwofaNewDevice($device->deviceName, $device->deviceIp));
        }
        else 
        {
            $this->notifyUser($userId, new TwofaStrangeDevice($device->deviceName, $device->deviceIp));
        }
    }
}
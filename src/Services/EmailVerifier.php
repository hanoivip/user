<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\UserVerifyWay;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Hanoivip\User\Mail\UserOtp;
use Hanoivip\Events\UserSecure\User2faUpdated;

class EmailVerifier implements IVerifier
{
    const way = 'email';
    
    protected $otp;
    
    public function __construct(OtpService $otp)
    {
        $this->otp = $otp;
    }
    
    public function add($userId, $value)
    {
        if (empty($value))
            return __("hanoivip.user::twofa.email.empty");
        $exists = UserVerifyWay::where('way', self::way)
        ->where('value', $value)
        ->where('verified', true)
        ->where('delete', false)
        ->get();
        if ($exists->isNotEmpty())
            return __("hanoivip.user::twofa.email.exists");
        $record = new UserVerifyWay();
        $record->user_id = $userId;
        $record->way = self::way;
        $record->value = $value;
        $record->save();
        // generate otp
        $otp = $this->otp->generate($userId);
        Mail::to($value)->send(new UserOtp($otp, 60 * 2));
        return true;
    }

    public function init()
    {
        return [];
    }

    public function startVerify($userId, $deviceId)
    {
        $record = UserVerifyWay::where('user_id', $userId)
        ->where('way', self::way)
        ->where('verified', true)
        ->where('delete', false)
        ->get();
        if ($record->isEmpty())
            return __('hanoivip.user::twofa.email.not-valid-email');
        $otp = $this->otp->generate($userId);
        //Log::debug("Send mail to " . $record->first()->value . " otp " . $otp);
        Mail::to($record->first()->value)->send(new UserOtp($otp, 60 * 2));
        return true;
    }

    public function verify($userId, $deviceId, $verifier)
    {
        $result = $this->otp->check($verifier);
        if ($result)
        {
            event(new User2faUpdated($userId, "email"));
        }
        return $result;
    }

    public function needValidation()
    {
        return true;
    }

    public function validate($userId, $value, $validator)
    {
        return $this->otp->check($validator);
    }
    
    public function remove($userId, $value)
    {
        return UserVerifyWay::where('user_id', $userId)
        ->where('way', self::way)
        ->where('value', $value)
        ->where('verified', true)
        ->update(['delete' => true]);
    }

    
}
<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\UserVerifyWay;
use PragmaRX\Google2FA\Google2FA;

class AuthenticatorVerifier implements IVerifier
{
    const way = 'authenticator';
    
    protected $google2fa;
    
    public function __construct(Google2FA $google2fa)
    {
        $this->google2fa = $google2fa;
    }
    
    public function add($userId, $value)
    {
        $record = new UserVerifyWay();
        $record->user_id = $userId;
        $record->way = self::way;
        $record->value = $value;
        $record->save();
    }

    public function init()
    {
        $key = $this->google2fa->generateSecretKey();
        $url = $this->google2fa->getQRCodeUrl(config('id.name.portal'), config('id.name.site'), $key);
        return ['qrcode' => $url, 'key' => $key];
    }

    public function startVerify($userId, $deviceId)
    {
        return true;
    }

    public function verify($userId, $deviceId, $verifier)
    {
        $record = UserVerifyWay::where('user_id', $userId)
        ->where('way', self::way)
        ->where('delete', false)
        ->get();
        if ($record->isEmpty())
            return __('hanoivip::twofa.authenticator.empty');
        return $this->google2fa->verifyKey($record->first()->value, $verifier);
    }

    public function needValidation()
    {
        return true;
    }

    public function validate($userId, $value, $validator)
    {
        return $this->google2fa->verifyKey($value, $validator);
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
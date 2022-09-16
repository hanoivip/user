<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\UserVerifyWay;

class CodeVerifier implements IVerifier
{
    const way = "code";
    const batch = 10;
    
    protected $otp;
    
    public function __construct(OtpService $otp)
    {
        $this->otp = $otp;
    }
    
    public function add($userId, $value)
    {
        // remove old batch
        $this->remove($userId, 0);
        // generate new batch
        $otps = [];
        for ($i=0; $i<self::batch; ++$i)
        {
            $otp = $this->otp->generateNumericOTP();
            $otps[] = [
                'user_id' => $userId,
                'way' => self::way,
                'value' => $otp,
                'verified' => true,
            ];
        }
        UserVerifyWay::insert($otps);
        return true;
    }

    public function init()
    {
        return [];
    }

    public function startVerify($userId, $deviceId)
    {}

    public function verify($userId, $deviceId, $verifier)
    {
        $record = UserVerifyWay::where('user_id', $userId)
        ->where('way', self::way)
        ->where('value', $verifier)
        ->where('delete', false)
        ->where('use_count', 0)
        ->get();
        return $record->isNotEmpty();
    }

    public function needValidation()
    {
        return false;
    }

    public function validate($userId, $value, $validator)
    {
        return false;
    }
    
    public function remove($userId, $value)
    {
        return UserVerifyWay::where('user_id', $userId)
        ->where('way', self::way)
        ->update(['delete' => true]);
    }
    
}
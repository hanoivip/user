<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\Otp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class OtpService
{
    function generateNumericOTP($len = 6) {
        
        $generator = "1357902468";
        $result = "";
        
        for ($i = 1; $i <= $len; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }
    
    function generate($userId = 0, $expires = 2)
    {
        $otp = $this->generateNumericOTP();
        // save record
        $record = new \Hanoivip\User\Otp();
        $record->address = $userId;
        $record->type = 0;
        $record->otp = $otp;
        $record->expires = Carbon::now()->addMinutes($expires)->timestamp;
        $record->save();
        return $otp;
    }
    
    function check($otp)
    {
        if (empty($otp))
            return false;
        Log::error("Otp checking $otp");
        $record = Otp::where('otp', $otp)->get();
        if ($record->isEmpty())
            return __('hanoivip.user::twofa.invalid');
        if (Carbon::now()->timestamp>=$record->first()->expires)
            return __('hanoivip.user::twofa.expired');
        return true;
    }
    
    function get($otp)
    {
        return Otp::where('otp', $otp)->first();
    }
}
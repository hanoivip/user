<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\Otp;
use Illuminate\Support\Carbon;

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
    
    function generate($expires = 2)
    {
        $otp = $this->generateNumericOTP();
        // save record
        $record = new \Hanoivip\User\Otp();
        $record->address = 'x';
        $record->type = 0;
        $record->otp = $otp;
        $record->expires = Carbon::now()->addMinutes($expires)->timestamp;
        $record->save();
        return $otp;
    }
    
    function check($otp)
    {
        $record = Otp::where('otp', $otp)->get();
        if ($record->isEmpty())
            return __('hanoivip::twofa.invalid');
        if (Carbon::now()->timestamp>=$record->first()->expires)
            return __('hanoivip::twofa.expired');
        return true;
    }
}
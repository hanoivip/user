<?php
namespace Hanoivip\User\Controllers;

use Carbon\Carbon;
use Hanoivip\User\Mail\UserOtp;
use Hanoivip\User\Services\SecureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tzsk\Otp\Facades\Otp;

class OtpController extends Controller
{
    protected $secures;

    public function __construct(
        SecureService $secures)
    {
        $this->secures = $secures;
    }
    
    function generateNumericOTP($n) {
        
        $generator = "1357902468";
        $result = "";
        
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }
    
    public function sendMail(Request $request)
    {
        $email = $request->input('email');
        $error = 0;
        $message = __('hanoivip::otp.success');
        if (!$this->secures->canSecureByEmail($email))
        {
            $error = 1;
            $message = __('hanoivip::otp.email-invalid');
        }
        else
        {
            // thottle?
            $otp = $this->generateNumericOTP(6);
            // save record
            $record = new \Hanoivip\User\Otp();
            $record->address = $email;
            $record->type = 1;
            $record->otp = $otp;
            $record->expires = Carbon::now()->addMinutes(2)->timestamp;
            $record->save();
            // send mail
            Mail::to($email)->send(new UserOtp($otp, 60 * 2));
        }
        return ['error'=>$error, 'message'=>$message];
    }
    
    public function sendSms(Request $request)
    {
        
    }
}

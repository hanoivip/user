<?php
namespace Hanoivip\User\Controllers;

use Hanoivip\User\Mail\UserOtp;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\PasswordService;
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
    
    public function sendMail(Request $request)
    {
        $email = $request->input('email');
        $error = 0;
        if (!$this->secures->canSecureByEmail($email))
        {
            $error = 1;
        }
        else
        {
            // thottle?
            $key = md5($email);
            $otp = Otp::digits(6)->expiry(120)->generate($key);
            // save record
            $record = new \App\Otp();
            $record->address = $email;
            $record->type = 1;
            $record->otp = $otp;
            $record->expires = 120;
            $record->save();
            // send mail
            Mail::to($email)->send(new UserOtp($otp, 120));
        }
        return ['error'=>$error, 'message'=>''];
    }
    
    public function sendSms(Request $request)
    {
        
    }
}

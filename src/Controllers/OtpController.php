<?php
namespace Hanoivip\User\Controllers;

use Carbon\Carbon;
use Hanoivip\User\Mail\UserOtp;
use Hanoivip\User\Services\SecureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Hanoivip\User\Services\OtpService;

class OtpController extends Controller
{
    protected $secures;
    
    protected $otp;

    public function __construct(
        SecureService $secures,
        OtpService $otp)
    {
        $this->secures = $secures;
        $this->otp = $otp;
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
            $otp = $this->otp->generate();
            // send mail
            Mail::to($email)->send(new UserOtp($otp, 60 * 2));
        }
        return ['error'=>$error, 'message'=>$message];
    }
    
    public function sendSms(Request $request)
    {
        
    }
}

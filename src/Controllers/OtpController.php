<?php
namespace Hanoivip\User\Controllers;

use Hanoivip\User\Mail\UserOtp;
use Hanoivip\User\Services\OtpService;
use Hanoivip\User\Services\SecureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    
    public function check(Request $request)
    {
        $otp = $request->input('otp');
        $result = $this->otp->check($otp);
        return ['error' => $result ? 0 : 1, 'message' => $result ? 'correct': 'incorrect'];
    }
}

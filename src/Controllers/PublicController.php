<?php
namespace Hanoivip\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Hanoivip\User\Otp;
use Hanoivip\User\Requests\ResetPassword;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\SecureService;
use Hanoivip\User\Services\PasswordService;
use Hanoivip\User\Services\OtpService;

class PublicController extends Controller
{

    protected $credentials;

    protected $secures;

    protected $resets;
    
    protected $otps;

    public function __construct(
        CredentialService $credentials, 
        SecureService $secures, 
        PasswordService $resets,
        OtpService $otps)
    {
        $this->credentials = $credentials;
        $this->secures = $secures;
        $this->resets = $resets;
        $this->otps = $otps;
    }

    /**
     * Xác thực email đăng nhập
     *
     * @param string $token
     */
    public function verifyEmail($token)
    {
        $message = '';
        $error_message = '';
        try {
            $result = $this->credentials->verify($token);
            if (gettype($result) == "boolean") {
                if ($result) {
                    $message = __("hanoivip.user::email.verify.success");
                } else
                    $error_message = __("hanoivip.user::email.verify.fail");
            } else
                $error_message = $result;
        } catch (Exception $ex) {
            Log::error("Verify login email exception. Msg:" . $ex->getMessage());
            $error_message = __("hanoivip.user::email.verify.exception");
        }
        return view("hanoivip::verify-login-result", [
            'message' => $message,
            'error_message' => $error_message
        ]);
    }

    /**
     * Xác thực email bảo mật
     *
     * @param string $token
     */
    public function verifySecureEmail($token)
    {
        $message = '';
        $error_message = '';
        try {
            $result = $this->secures->verify($token);
            if (gettype($result) == "boolean") {
                if ($result) {
                    $message = __("hanoivip.user::secure.email.verify.success");
                } else
                    $error_message = __("hanoivip.user::secure.email.verify.fail");
            } else
                $error_message = $result;
        } catch (Exception $ex) {
            Log::error("Verify secure email exception. Msg:" . $ex->getMessage());
            $error_message = __("hanoivip.user::secure.email.verify.exception");
        }
        return view("hanoivip::verify-secure-result", [
            'message' => $message,
            'error_message' => $error_message
        ]);
    }

    public function forgotPassUI(Request $request)
    {
        return view('hanoivip::password-forgot');
    }

    public function forgotPass(Request $request)
    {
        $email = $request->input('email');
        $sentResult = $this->resets->sendResetEmail($email);
        if ($sentResult === true) {
            return view('hanoivip::password-forgot-sent', [
                'message' => __('hanoivip.user::secure.reset.email-sent')
            ]);
        } else {
            return view('hanoivip::password-forgot-sent', [
                'error_message' => $sentResult
            ]);
        }
    }
    
    public function resetPassUI(Request $request)
    {
        $token = $request->input('token');
        if ($this->resets->validate($token) === false)
            return view('hanoivip::password-forgot-reset-result',
                ['error_message' => __('hanoivip.user::secure.reset.token-invalid')]);
        else
            return view('hanoivip::password-forgot-reset', ['token' => $token]);
    }

    /**
     * Reset password by resettoken
     * @param Request $request
     * @return number[]|string[]|array[]|NULL[]
     * @deprecated
     */
    public function resetPass(Request $request)
    {
        $token = $request->input('resettoken');
        $password = $request->input('newpass');
        $validator = Validator::make($request->all(), [
            'newpass' => 'required|string|min:8|confirmed',
            'resettoken' => 'required|string',
        ]);
        $error = 0;
        $message = '';
        if ($validator->fails())
        {
            if ($request->ajax())
                return ['error' => 1, 'message' => __('hanoivip.user::secure.reset.validation-fail')];
            else
                return view('hanoivip::password-forgot-reset', ['token' => $token])->withErrors($validator->errors());
        }
        try {
            $result = $this->resets->resetPassword($token, $password);
            if ($result == true)
                $message = __('hanoivip.user::secure.reset.success');
            else
            {
                $error = 1;
                $message = $result;
            }
        } catch (Exception $e) {
            $error = 999;
            $message = __('hanoivip.user::secure.reset.exception');
            Log::error("User reset password exception: " . $e->getMessage());
        }
        if ($request->ajax())
            return ['error' => $error, 'message' => $message];
        return view('hanoivip::password-forgot-reset-result', ['error' => $error, 'message' => $message]);
    }
    
    public function resetPassByOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
            'otp' => 'required|string',
        ]);
        $error = 0;
        $message = '';
        if ($validator->fails())
        {
            $error = 1;
            $message = __('hanoivip.user::secure.reset.validation-fail');
        }
        else
        {
            $otp = $request->input('otp');
            $password = $request->input('password');
            $record = $this->otps->get($otp);
            $userID = $record->address;
            try {
                $result = $this->credentials->updatePass($userID, $password);
                if ($result === true)
                    $message = __('hanoivip.user::secure.reset.success');
                else
                {
                    $error = 2;
                    $message = $result;
                }
            } catch (Exception $e) {
                $error = 999;
                $message = __('hanoivip.user::secure.reset.exception');
                Log::error("User reset password exception: " . $e->getMessage());
            }
        }
        if ($request->ajax())
            return ['error' => $error, 'message' => $message];
        return view('hanoivip::password-forgot-reset-result', ['error' => $error, 'message' => $message]);
    }
    
    public function terminate(Request $request)
    {
        if ($request->getMethod() == 'POST')
        {
            return view('hanoivip::user-termination-ok');
        }
        else 
        {
            return view('hanoivip::user-termination');
        }
    }
}

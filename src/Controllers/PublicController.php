<?php
namespace Hanoivip\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Hanoivip\User\Otp;
use Hanoivip\User\Requests\ResetPassword;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\SecureService;
use Hanoivip\User\Services\PasswordService;

class PublicController extends Controller
{

    protected $credentials;

    protected $secures;

    protected $resets;

    public function __construct(
        CredentialService $credentials, 
        SecureService $secures, 
        PasswordService $resets)
    {
        $this->credentials = $credentials;
        $this->secures = $secures;
        $this->resets = $resets;
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
                    $message = __("hanoivip::email.verify.success");
                } else
                    $error_message = __("hanoivip::email.verify.fail");
            } else
                $error_message = $result;
        } catch (Exception $ex) {
            Log::error("Verify login email exception. Msg:" . $ex->getMessage());
            $error_message = __("hanoivip::email.verify.exception");
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
                    $message = __("hanoivip::secure.email.verify.success");
                } else
                    $error_message = __("hanoivip::secure.email.verify.fail");
            } else
                $error_message = $result;
        } catch (Exception $ex) {
            Log::error("Verify secure email exception. Msg:" . $ex->getMessage());
            $error_message = __("hanoivip::secure.email.verify.exception");
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
                'message' => __('hanoivip::secure.reset.email-sent')
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
                ['error_message' => __('hanoivip::secure.reset.token-invalid')]);
        else
            return view('hanoivip::password-forgot-reset', ['token' => $token]);
    }

    // Reset password by email link
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
                return ['error' => 1, 'message' => __('hanoivip::secure.reset.validation-fail')];
            else
                return view('hanoivip::password-forgot-reset', ['token' => $token])->withErrors($validator->errors());
        }
        try {
            $result = $this->resets->resetPassword($token, $password);
            if ($result == true)
                $message = __('hanoivip::secure.reset.success');
            else
            {
                $error = 1;
                $message = $result;
            }
        } catch (Exception $e) {
            $error = 999;
            $message = __('hanoivip::secure.reset.exception');
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
            $message = __('hanoivip::secure.reset.validation-fail');
        }
        else
        {
            $otp = $request->input('otp');
            $password = $request->input('password');
            try {
                $result = $this->resets->resetPasswordByOtp($otp, $password);
                if ($result === true)
                    $message = __('hanoivip::secure.reset.success');
                else
                {
                    $error = 2;
                    $message = $result;
                }
            } catch (Exception $e) {
                $error = 999;
                $message = __('hanoivip::secure.reset.exception');
                Log::error("User reset password exception: " . $e->getMessage());
            }
        }
        if ($request->ajax())
            return ['error' => $error, 'message' => $message];
        return view('hanoivip::password-forgot-reset-result', ['error' => $error, 'message' => $message]);
    }
    
    public function test(Request $request)
    {
        $otp = $request->input('otp');
        $record = Otp::where("otp", $otp)->first();
        return $record->first();
    }
}

<?php
namespace Hanoivip\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
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

    public function resetPass(Request $request)
    {
        $token = $request->input('resettoken');
        $password = $request->input('newpass');
        $validator = Validator::make($request->all(), [
            'newpass' => 'required|string|min:8|confirmed',
            'resettoken' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return view('hanoivip::password-forgot-reset', ['token' => $token])->withErrors($validator->errors());
        }
        $result = $this->resets->resetPassword($token, $password);
        if ($result == true)
            return view('hanoivip::password-forgot-reset-result',
                ['message' => __('hanoivip::secure.reset.success')]);
        else
            return view('hanoivip::password-forgot-reset-result',
                ['error_message' => $result]);
    }
}

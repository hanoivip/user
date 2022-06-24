<?php

namespace Hanoivip\User\Services;

use Carbon\Carbon;
use Hanoivip\User\PasswordReset;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Hanoivip\User\Mail\ResetPassword;
use Hanoivip\User\Otp;

class PasswordService
{
    private $secure;
    private $credentials;
    
    public function __construct(
        SecureService $secure,
        CredentialService $credentials)
    {
        $this->secure = $secure;
        $this->credentials = $credentials;
    }
    
    /**
     * Người dùng quên mật khẩu, yêu cầu reset qua email bảo mật
     *
     * Xử lý:
     * - Nếu email tồn tại và đã đc xác thực thì tiếp tục
     * - Sinh bản ghi để thiết lập lại
     * - Gửi email
     *
     * Ngoại lệ
     *
     * @param string $email
     * @return true|string
     */
    public function sendResetEmail($email)
    {
        if (!$this->secure->canSecureByEmail($email))
            return __('hanoivip::secure.reset.email-invalid');
        // Check exists
        $record = PasswordReset::where('email', $email)->get();
        if ($record->isEmpty())
        {
            $record = new PasswordReset();
            $record->email = $email;
            // check throtte
            if (Carbon::now()->timestamp - $record->created_at < 120)
                return __('hanoivip::secure.reset.too-fast');
        }
        else
        {
            $record=$record->first();
        }
        $record->token = str_random(64);
        $record->created_at = Carbon::now();
        $record->save();
        
        Mail::to($email)->send(new ResetPassword($record->token));
        return true;
    }
    
    /**
     * Kiểm tra token còn hợp lệ ko
     * 
     * BR:
     * - Tồn tại 
     * - Còn hạn
     * 
     * @param string $token
     * @return false|PasswordReset
     */
    public function validate($token)
    {
        $record = PasswordReset::where('token', $token)->get();
        if ($record->isEmpty())
            return false;
        $record=$record->first();
        if (Carbon::now()->diffInSeconds(new Carbon($record->created_at)) >= config('id.email.expires'))
            return false;
        return $record;
    }
    
    /**
     * Thực hiện đặt lại mật khẩu theo token
     * 
     * Xử lý
     * - Kiểm tra token còn hợp lệ không
     * - Kích hoạt đặt lại mật khẩu
     */
    public function resetPassword($token, $password)
    {
        if (($record = $this->validate($token)) === false)
            return __('hanoivip::secure.reset.token-invalid'); 
        $secureInfo = $this->secure->getRecordByEmail($record->email);
        $result = $this->credentials->updatePass($secureInfo->user_id, $password);
        if ($result)
        {
            $record->token = 'xxx';
            $record->save();
        }
        return $result;
    }
    
    public function resetPasswordByOtp($otp, $password)
    {
        $record = Otp::where('otp', $otp)->get();
        if ($record->isEmpty())
            return __('hanoivip::secure.otp-invalid');
        $result = $this->credentials->updatePass($record->first()->userSecure->first()->user_id, $password);
        return $result;
    }
}
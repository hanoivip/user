<?php

namespace Hanoivip\User\Services;

use Carbon\Carbon;
use Hanoivip\User\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Hanoivip\User\Mail\ResetPassword;

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
            return __('hanoivip.user::secure.reset.email-invalid');
        // Check exists
        $record = PasswordReset::where('email', $email)->get();
        if ($record->isEmpty())
        {
            $record = new PasswordReset();
            $record->email = $email;
            // check throtte
            if (Carbon::now()->timestamp - $record->created_at < 120)
                return __('hanoivip.user::secure.reset.too-fast');
        }
        else
        {
            $record=$record->first();
        }
        $record->token = Str::random(64);
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
            return __('hanoivip.user::secure.reset.token-invalid'); 
        $secureInfo = $this->secure->getRecordByEmail($record->email);
        $result = $this->credentials->updatePass($secureInfo->user_id, $password);
        if ($result)
        {
            $record->token = 'done';
            $record->save();
        }
        return $result;
    }
}
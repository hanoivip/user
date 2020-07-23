<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use Hanoivip\User\Mail\ValidationMail;
use Hanoivip\User\PasswordHistory;

class CredentialService
{
    protected $authenticator;
    
    protected $secures;
    
    public function __construct(SecureService $secures,
        AuthenticateService $authenticator)
    {
        $this->secures = $secures;
        $this->authenticator = $authenticator;
    }
    
    /**
     * Get user all credentials info. 
     * Can query by UID or Username
     * 
     * @param number|string $uidOrUsername
     * @return User
     */
    public function getUserCredentials($uidOrUsername)
    {
        if (is_numeric($uidOrUsername))
            return User::find($uidOrUsername);
        else
            return User::where('name', $uidOrUsername)->first();
    }
    
    /**
     * 
     * Cập nhật/thiết lập email đăng nhập. Chỉ được 1 email duy nhất.
     * 
     * Validator:
     * + Định dạng email
     * + Khác với email hiện tại
     * + Duy nhất (đăng nhập & bảo mật)
     * 
     * Điều kiện đầu:
     * + Email chưa được cập nhật hoặc chưa xác thực
     * 
     * Xử lý:
     * + Kiểm tra khoảng thời gian giữa với lần gần nhát.
     * + Cập nhật email, thời gian thực hiện.
     * + Gửi email yêu cầu xác thực
     * 
     * Điều kiện sau:
     * + Chưa xác thực email nào
     * + Đã xác thực cần liên hệ hỗ trợ để đổi
     * 
     * @param number $uid
     * @param string $email
     * @throws Exception
     * @return boolean|string
     */
    public function updateEmail($uid, $email)
    {
        $credential = $this->getUserCredentials($uid);
        if (empty($credential->email) || empty($credential->email_verified))
        {
            $now = Carbon::now();
            //Generate token
            $token = $this->generateToken();
            //Save
            $credential->email = $email;
            $credential->last_email_validation = $now;
            $credential->email_validation_token = $token;
            $credential->email_verified = false;
            $credential->save();
            //Send mail
            Mail::send(new ValidationMail($credential, $token));
            return true;
        }
        else 
        {
            return __('hanoivip::email.update.verified');
        }
    }
    
    protected function generateToken()
    {
        return str_random(64);
    }
    
    /**
     * Gửi lại email xác thực.
     * 
     * Điều kiện đầu:
     * + Đã cập nhật email
     * 
     * Xử lý
     * + Kiểm tra đã xác thực chưa
     * + Sinh token xác thực, gửi email
     * + Cập nhật thời gian gửi
     * 
     * Điều kiện sau:
     * + Email xác thực mới được gửi
     * + Thời điểm mới gửi được cập nhật
     * 
     * @param number $uid
     * @return boolean|string
     */
    public function resendEmail($uid)
    {
        $user = $this->getUserCredentials($uid);
        if ($user['email_verified'] === true)
            throw new Exception('User login email already verified.');
        $now = Carbon::now();
        $token = $this->generateToken();
        //Save
        $user->last_email_validation = $now;
        $user->email_validation_token = $token;
        $user->email_verified = false;
        $user->save();
        //Send mail
        Mail::send(new ValidationMail($user, $token));
        return true;
    }
    
    /**
     * Cập nhật mật khẩu của ng chơi
     * 
     * Note: các côgn việc sau phân công cho validator
     * + Kiểm tra mật khẩu cũ
     * + Kiểm tra xác nhận mật khẩu
     * + Kiểm tra độ khó của mật khẩu mới
     * + Kiểm tra khác mk cũ
     * + Captcha
     * 
     * Điều kiện đầu:
     * + Đã đăng nhập
     * 
     * Xử lý:
     * + Kiểm tra mk mới có giống mk2, câu trả lời ko
     * + Lưu lịch sử mật khẩu.
     * + Cập nhật mk
     * + Đăng xuất trên tất cả các thiết bị (->controller)
     * 
     * Điều kiện sau:
     * + Mk được cập nhật
     * + Đăng xuất tại tất cả các thiết bị đã đăng nhập
     * 
     * @param number $uid
     * @param string $newpass
     * @throws Exception
     * @return boolean|string true if success, false or string if failure 
     */
    public function updatePass($uid, $newpass)
    {
        $user = $this->getUserCredentials($uid);
        $userSecure = $this->secures->getInfo($uid);
        if (!empty($userSecure) && !empty($userSecure->pass2) &&
            Hash::check($newpass, $userSecure->pass2))
            return __('hanoivip::password.update.similar_pass2');
        if (!empty($userSecure) && !empty($userSecure->answer) &&
            Hash::check($newpass, $userSecure->answer))
            return __('hanoivip::password.update.similar_answer');
        //Save history    
        $history = new PasswordHistory();
        $history->user_id = $uid;
        $history->old_password = $user->password;
        $history->save();
        //Save new pass
        $user->password = Hash::make($newpass);
        $user->save();
        return true;
    }
    
    /**
     * Xác thực dựa trên 1 token.
     * 
     * Xử lý:
     * + Xác định sự tồn tại
     * + Xác định đã hết hạn chưa
     * 
     * 
     * @param string $token
     * @param User $affectedUser
     * @return boolean|string
     */
    public function verify($token, &$affectedUser = null)
    {
        $user = User::where('email_validation_token', $token)->get();
        if ($user->isEmpty())
        {
            Log::debug('Credential not found user by validation token.');
            return false;
        }
        if ($user->count() > 1)
        {
            throw new Exception('Credential token generation not good. Duplicated.');
        }
        $userByToken = $user->first();
        if (empty($userByToken->last_email_validation))
        {
            Log::error('Credential last email validation not set.');
            return false;
        }
        $now = Carbon::now();
        $mailTime = new Carbon($userByToken->last_email_validation);
        if ($now->diffInSeconds() > config('id.email.expires'))
        {
            Log::debug('Credential link was expired.');
            return false;
        }
        
        $userByToken->email_verified = true;
        $userByToken->save();
        
        if (isset($affectedUser))
            $affectedUser = $userByToken;
        return true;
    }
    
    /**
     * 
     * @param number $uid
     * @param array $info
     */
    public function updatePersonal($uid, $info)
    {
        //Log::debug('Credential update personal info.' . print_r($info, true));
        $user = $this->getUserCredentials($uid);
        $user->hoten = $info['hoten'];
        $user->sex = $info['sex'];
        $user->birthday = new Carbon($info['birthday']);
        $user->address = $info['address'];
        $user->city = $info['city'];
        $user->career = $info['career'];
        $user->mariage = $info['marriage'];
        $user->save();
        return true;
    }
}
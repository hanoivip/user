<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\User;
use Hanoivip\User\UserSecure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use Hanoivip\User\Mail\ValidateSecure;
use Carbon\Carbon;

class SecureService
{
    
    protected $authenticator;
    
    public function __construct(AuthenticateService $authenticator)
    {
        $this->authenticator = $authenticator;    
    }
    
    /**
     * Lấy bản ghi bảo mật của người chơi.
     * 
     * @param number $uid
     * @return UserSecure
     */
    public function getInfo($uid)
    {
        $info = UserSecure::find($uid);
        if (empty($info))
        {
            $info = new UserSecure();
            $info->user_id = $uid;
            $info->save();
        }
        return $info;
    }
    
    protected function generateToken()
    {
        return str_random(64);
    }
    
    /**
     * Thiết lập/cập nhật email.
     * 
     * BR:
     * + Khoảng cách giữa 2 lần thực hiện cách nhau ít nhất 5p.
     * + Nếu chưa thiết lập: cần phải nhập đúng các thông tin bảo mật khác
     * - CMTND
     * - Xác thực qua điện thoại
     * + Nếu đã thiết lập mà chưa xác thực
     * => cứ đổi
     * + Nếu đã thiết lập và đã xác thực
     * => cứ đổi
     * 
     * Validation:
     * + Xác nhận có nhớ CMTND (nếu đã thiết lập)
     * + Xác thực có nhớ email cũ
     * + Mail mới khác mail cũ
     * + Phải thực hiện cách nhau ít nhất 5p.
     * + Mail chưa có ai dùng
     * 
     * Điều kiện đầu:
     * + Đã đăng nhập
     * + Đã xác thực 2 bước với sms (nếu hệ thống hỗ trợ sms-gateway)
     * 
     * Xử lý
     * + Kiểm tra không trùng lặp với các email bảo mật & đăng nhập khác.
     * + Cập nhật và gửi email xác thực mới.
     * 
     * 
     * @param number $uid
     * @param string $newmail
     * @throws Exception
     * @return boolean|string
     */
    public function updateEmail($uid, $newmail)
    {
        $otherSecure = UserSecure::where('email', $newmail)->get();
        if (!$otherSecure->isEmpty())
            return __('hanoivip::secure.email.exists');
        $otherLogin = User::where('email', $newmail)->get();
        if (!$otherLogin->isEmpty())
            return __('hanoivip::secure.email.exists');
        $info = $this->getInfo($uid);
        $token = $this->generateToken();
        //Save new info
        $info->email = $newmail;
        $info->email_validation_token = $token;
        $info->email_verified = false;
        $info->last_email_validation = Carbon::now();
        $info->save();
        //Send validation email
        $user = User::find($uid);
        Mail::to($newmail)->send(new ValidateSecure($user, $token));
        return true;
    }
    
    /**
     * Gửi lại email xác thực
     * 
     * Điều kiện đầu:
     * + Đã cập nhật email xác thực mà chưa xác thực
     * 
     * Xử lý:
     * + Kiểm tra business rule 1 thời gian
     * + Kiểm tra email & tình trạng xác thực
     * + Gửi lại email xác thực, cập nhật thời gian gửi
     * 
     * Điều kiện sau:
     * + Email xác thực được gửi lại
     * 
     * BR1: 
     * + Khoảng cách giữa các lần gủi cách nhau ít nhất 5p.
     * 
     * @param number $uid
     * @return boolean
     */
    public function resendEmail($uid)
    {
        $secure = $this->getInfo($uid);
        if ($secure->email_verified === true)
            throw new Exception('User login email already verified.');
        $now = Carbon::now();
        $token = $this->generateToken();
        //Save
        $secure->last_email_validation = $now;
        $secure->email_validation_token = $token;
        $secure->email_verified = false;
        $secure->save();
        //Send mail
        $user = User::find($uid);
        Mail::to($secure->email)->send(new ValidateSecure($user, $token));
        return true;
    }
    
    /**
     * 
     * Cập nhật mã game (mật khẩu cấp 2). Quy tắc:
     * + Nếu đã thiết lập CMTND=> xác thực
     * + Nếu đã thiết lập mã game=> xác thực
     * + Mk mới phải khác mk cũ
     * + Không cho mã game trùng vs mật khẩu, câu trả lời bảo mật
     * 
     * 
     * @param number $uid
     * @param string $newpass2
     * @throws Exception
     * @return boolean|string
     */
    public function updatePass2($uid, $newpass2)
    {
        $user = User::find($uid);
        $secure = UserSecure::find($uid);
        if (Hash::check($newpass2, $user->password))
            return __('hanoivip::secure.update.pass2.duplicated_not_good');
        if (!empty($secure->answer) &&
            Hash::check($newpass2, $secure->answer))
            return __('hanoivip::secure.update.pass2.duplicated_not_good');
        //Save
        $secure->pass2 = Hash::make($newpass2);
        $secure->save();
        return true;
    }
    
    /**
     * Cập nhật câu hỏi bảo mật
     * 
     * Quy tắc:
     * + Nếu đã thiết lập CMTND=> xác thực
     * + Nếu đã thiết lập câu hỏi & trả lời => xác thực
     * + Kiểm tra câu trả lời không trùng các giá trị bảo mật khác
     * (pass, pass2)
     * 
     * Điều kiện ra:
     * + Câu hỏi & trả lời được cập nhật
     * + Đăng xuất
     * 
     * @param number $uid
     * @param number $question
     * @param string $answer
     * @return boolean|string
     */
    public function updateQna($uid, $question, $answer)
    {
        $user = User::find($uid);
        $secure = UserSecure::find($uid);
        if (Hash::check($answer, $user->password))
            return __('hanoivip::secure.update.qna.duplicated_not_good');
        if (Hash::check($answer, $secure->pass2))
            return __('hanoivip::secure.update.qna.duplicated_not_good');
        //Save
        $secure->question = $question;
        $secure->answer = Hash::make($answer);
        $secure->save();
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
        $user = UserSecure::where('email_validation_token', $token)->get();
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
        {
            $uid = $user->user_id;
            $affectedUser = User::find($uid);
        }
            
        return true;
    }
}
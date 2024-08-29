<?php

namespace Hanoivip\User\Controllers;

use Hanoivip\User\Requests\SecureEmail;
use Hanoivip\User\Requests\UpdatePass2;
use Hanoivip\User\Requests\UpdateQna;
use Hanoivip\User\Services\SecureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
/**
 * @deprecated
 * @author GameOH
 * No one use
 * - pass2
 * - question
 * - email: make confusion with authentication email 
 */
class SecurityController extends Controller
{
    protected $secureService;
    
    public function __construct(SecureService $secure)
    {
        $this->secureService = $secure;
    }

    public function infoUI(Request $request)
    {
        $uid = Auth::user()->getAuthIdentifier();
        $secure = $this->secureService->getInfo($uid);
        if ($request->ajax())
        {
            
        }
        return view('hanoivip::secure-info', ['info' => $secure]);
    }
    
    public function updateEmailUI()
    {
        $uid = Auth::user()->getAuthIdentifier();
        $secure = $this->secureService->getInfo($uid);
        return view('hanoivip::secure-update-email', ['info' => $secure]);
    }
    
    public function doUpdateEmail(SecureEmail $request)
    {
        $uid = Auth::user()->getAuthIdentifier();
        $newmail = $request->input('newmail');
        $phone = $request->input('phone');
        $message = '';
        $error_message = '';
        
        if (config('id.sms.enabled', false))
        {
            if (!empty($phone))
            {
                // 2 steps authentication by sms
                $error_message = 'Sms not supported yet!';
            }
        }
        else 
        {
            try
            {
                $result = $this->secureService->updateEmail($uid, $newmail);
                if (gettype($result) == "boolean")
                {
                    if ($result)
                    {
                        $message = __('hanoivip.user::secure.email.update.success');
                        Auth::guard()->logout();
                        $request->session()->invalidate();
                    }
                    else
                        $error_message = __('hanoivip.user::secure.email.update.fail');
                }
                else 
                    $error_message = $result;
            }
            catch (Exception $ex)
            {
                Log::error("Secure update email exception. Msg:" . $ex->getMessage());
                $error_message = __('hanoivip.user::secure.email.update.exception');
            }
        }
        return view('hanoivip::secure-update-email-result', ['message' => $message, 'error_message' => $error_message]);
    }
    
    public function resendEmail()
    {
        $uid = Auth::user()->getAuthIdentifier();
        $message = '';
        $error_message = '';
        try 
        {
            if ($this->secureService->resendEmail($uid))
                $message = __('hanoivip.user::secure.email.resend.success');
            else
                $error_message = __('hanoivip.user::secure.email.resend.fail');
        }
        catch (Exception $ex)
        {
            Log::error("Secure resend email exception. Msg:" . $ex->getMessage());
            $error_message = __('hanoivip.user::secure.email.resend.exception');
        }
        return view('hanoivip::secure-resend-email-result', ['message' => $message, 'error_message' => $error_message ]);
    }
    
    public function updatePass2()
    {
        $uid = Auth::user()->getAuthIdentifier();
        $secure = $this->secureService->getInfo($uid);
        return view('hanoivip::secure-update-pass2', ['info' => $secure]);
    }
    
    public function doUpdatePass2(UpdatePass2 $request)
    {
        $uid = Auth::user()->getAuthIdentifier();
        $newpass2 = $request->input('newpass2');
        $message = '';
        $error_message = '';
        try 
        {
            $result = $this->secureService->updatePass2($uid, $newpass2);
            if (gettype($result) == "boolean")
            {
                if ($result)
                {
                    $message = __('hanoivip.user::secure.pass2.update.success');
                    Auth::guard()->logout();
                    $request->session()->invalidate();
                }
                else 
                    $error_message = __('hanoivip.user::secure.pass2.update.fail');
            }
            else
                $error_message = $result;
        } 
        catch (Exception $ex) 
        {
            Log::error("Secure update pass2 exception. Msg:" . $ex->getMessage());
            $error_message = __('hanoivip.user::secure.pass2.update.exception');
        }
        return view('hanoivip::secure-update-pass2-result', ['message' => $message, 'error_message' => $error_message]);
    }
    
    public function updateQna()
    {
        $uid = Auth::user()->getAuthIdentifier();
        $secure = $this->secureService->getInfo($uid);
        $questions = [];
        for ($i=1; $i<=20; ++$i)
            $questions[] = [ $i, __('hanoivip.user::secure.qna.question' . $i) ];
        return view('hanoivip::secure-update-qna', ['info' => $secure, 'questions' => $questions]);
    }
    
    public function doUpdateQna(UpdateQna $request)
    {
        $uid = Auth::user()->getAuthIdentifier();
        $question = $request->input('newquestion');
        $answer = $request->input('newanswer');
        $message = '';
        $error_message = '';
        try 
        {
            $result = $this->secureService->updateQna($uid, $question, $answer);
            if (gettype($result) == "boolean")
            {
                if ($result)
                {
                    $message = __('hanoivip.user::secure.qna.update.success');
                    Auth::guard()->logout();
                    $request->session()->invalidate();
                }
                else
                    $error_message = __('hanoivip.user::secure.qna.update.fail');
            }
            else 
                $error_message = $result;
        }
        catch (Exception $ex)
        {
            Log::error("Secure update qna exception. Msg:" . $ex->getMessage());
            $error_message = __('hanoivip.user::secure.qna.update.exception');
        }
        return view('hanoivip::secure-update-qna-result', ['message' => $message, 'error_message' => $error_message]);
    }
}

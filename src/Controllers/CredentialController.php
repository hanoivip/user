<?php

namespace Hanoivip\User\Controllers;

use Hanoivip\User\User;
use Hanoivip\User\Services\CredentialService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use Hanoivip\User\Http\Requests\UpdateEmail;
use Hanoivip\User\Http\Requests\UpdatePassword;
use Hanoivip\User\Http\Requests\UpdatePersonal;
use Carbon\Carbon;

class CredentialController extends Controller
{
    protected $credentialMgr;
    
    public function __construct(CredentialService $credentialMgr)
    {
        $this->middleware('auth');
        
        $this->credentialMgr = $credentialMgr;
    }

    public function infoUI()
    {
        $uid = Auth::user()->id;
        $credential = $this->credentialMgr->getUserCredentials($uid);
        return view('credential-info', ['credential' => $credential]);
    }
    
    public function updateEmailUI()
    {
        return view('input-email');
    }

    /**
     * Utilize form request
     * + Automatic handle validation
     * + Store rule along with request
     * + Handling authorization
     * + Reduce cost in controller
     * 
     * @param UpdateEmail $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function doUpdateEmail(UpdateEmail $request)
    {
        $email = $request->input('email');
        $uid = Auth::user()->id;
        $message = '';
        $error_message = '';
        try 
        {
            $result = $this->credentialMgr->updateEmail($uid, $email);
            if (gettype($result) == "boolean")
            {
                if ($result)
                    $message = __('email.update.success', ['email' => $email]);
                else 
                    $error_message = __('email.update.fail');
            }
            else
                $error_message = $result;
        }
        catch (Exception $ex)
        {
            Log::error("Update login email exception. Msg:" . $ex->getMessage());
            $error_message = __('email.update.exception');
        }
        return view('input-email-result', ['message' => $message, 'error_message' => $error_message]);
    }
    
    protected function isTooFast($uid)
    {
        $interval = config('id.email.toofast');
        $user = User::find($uid);
        if (!empty($user->last_email_validation))
        {
            $now = Carbon::now();
            $lastEmail = new Carbon($user->last_email_validation);
            $diff = $now->diffInSeconds($lastEmail);
            return $diff < $interval;
        }
        return false;
    }
    
    public function resendEmail()
    {
        $uid = Auth::user()->id;
        $message = '';
        $error_message = '';
        try 
        {
            if ($this->isTooFast($uid))
                $error_message = __('email.resend.toofast');
            else if ($this->credentialMgr->resendEmail($uid))
                $message = __('email.resend.success');
            else
                $error_message = __('email.resend.fail');
        }
        catch (Exception $ex)
        {
            Log::error("Resend email validation exception. Msg:" . $ex->getMessage());
            $error_message = __('email.resend.exception');
        }
        return view('resend-email-result', ['message' => $message, 'error_message' => $error_message]);
    }
    
    public function updatePasswordUI()
    {
        Log::debug('xxxx');
        return view('password-update');
    }
    
    public function doUpdatePassword(UpdatePassword $request)
    {
        $newpass = $request->input('newpass');
        $uid = Auth::user()->id;
        $message = '';
        $error_message = '';
        try 
        {
            $result = $this->credentialMgr->updatePass($uid, $newpass);
            if (gettype($result) == 'boolean')
            {
                if ($result)
                {
                    $message = __('password.update.success');
                    //Auto logout
                    Auth::guard()->logout();
                    $request->session()->invalidate();
                }
                else
                    $error_message = __('password.update.fail');
            }
            else
                $error_message = $result;
        }
        catch (Exception $ex)
        {
            Log::error("Update password exception. Msg: " . $ex->getMessage());
            $error_message = __('password.update.exception');
        }
        return view('password-update-result', ['message' => $message, 'error_message' => $error_message]);
    }
    
    public function personalInfo()
    {
        $uid = Auth::user()->id;
        $credential = $this->credentialMgr->getUserCredentials($uid);
        return view('personal-info', ['personal' => $credential]);
    }
    
    public function updatePersonalUI()
    {
        $sexs = [];
        for ($i=1; $i<6; $i++)
            $sexs[] = [ $i, __('credential.personal.sex' . $i) ];
        $cities = [];
        for ($i=1; $i<65; $i++)
            $cities[] = [ $i, __('credential.personal.city' . $i) ];
        $careers = [];
        for ($i=1; $i<10; $i++)
            $careers[] = [ $i, __('credential.personal.career' . $i) ];
        $marriages = [];
        for ($i=1; $i<4; $i++)
            $marriages[] = [ $i, __('credential.personal.marriage' . $i) ];
        $uid = Auth::user()->id;
        $credential = $this->credentialMgr->getUserCredentials($uid);
        return view('personal-update', [ 'personal' => $credential, 'cities' => $cities, 
            'careers' => $careers, 'sexs' => $sexs, 'marriages' => $marriages ]);
    }
    
    public function doUpdatePersonal(UpdatePersonal $request)
    {
        $uid = Auth::user()->id;
        $message = '';
        $error_message = '';
        try 
        {
            if ($this->credentialMgr->updatePersonal($uid, $request->all()))
                $message = __('personal.update.success');
            else
                $error_message = __('personal.update.fail');
            
        }
        catch (Exception $ex)
        {
            Log::error("Update personal exception. Msg: " . $ex->getMessage());
            $error_message = __('personal.update.exception');
        }
        return view('personal-update-result', ['message' => $message, 'error_message' => $error_message]);
    }
}

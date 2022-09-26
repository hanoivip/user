<?php

namespace Hanoivip\User\Controllers;

use Hanoivip\User\User;
use Hanoivip\User\Services\CredentialService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use Hanoivip\User\Requests\UpdateEmail;
use Hanoivip\User\Requests\UpdatePassword;
use Hanoivip\User\Requests\UpdatePersonal;
use Carbon\Carbon;

class CredentialController extends Controller
{
    protected $credentialMgr;
    
    public function __construct(CredentialService $credentialMgr)
    {
        $this->credentialMgr = $credentialMgr;
    }

    public function infoUI()
    {
        $uid = Auth::user()->id;
        $credential = $this->credentialMgr->getUserCredentials($uid);
        return view('hanoivip::credential-info', ['credential' => $credential]);
    }
    
    public function updateEmailUI()
    {
        return view('hanoivip::input-email');
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
            if ($result === true)
            {
                $message = __('hanoivip::email.update.success', ['email' => $email]);
            }
            else
                $error_message = $result;
        }
        catch (Exception $ex)
        {
            Log::error("Update login email exception. Msg:" . $ex->getMessage());
            $error_message = __('hanoivip::email.update.exception');
        }
        return view('hanoivip::input-email-result', ['message' => $message, 'error_message' => $error_message]);
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
                $error_message = __('hanoivip::email.resend.toofast');
            else if ($this->credentialMgr->resendEmail($uid))
                $message = __('hanoivip::email.resend.success');
            else
                $error_message = __('hanoivip::email.resend.fail');
        }
        catch (Exception $ex)
        {
            Log::error("Resend email validation exception. Msg:" . $ex->getMessage());
            $error_message = __('hanoivip::email.resend.exception');
        }
        return view('hanoivip::resend-email-result', ['message' => $message, 'error_message' => $error_message]);
    }
    
    public function updatePasswordUI()
    {
        return view('hanoivip::password-update');
    }
    
    public function doUpdatePassword(UpdatePassword $request)
    {
        $newpass = $request->input('newpass');
        $uid = Auth::user()->id;
        $message = '';
        $error=0;
        try 
        {
            $result = $this->credentialMgr->updatePass($uid, $newpass);
            if (gettype($result) == 'boolean')
            {
                if ($result)
                {
                    $message = __('hanoivip::password.update.success');
                }
                else
                {
                    $error = 1;
                    $message = __('hanoivip::password.update.fail');
                }
            }
            else
            {
                $error = 2;
                $message = $result;
            }
        }
        catch (Exception $ex)
        {
            Log::error("Update password exception. Msg: " . $ex->getMessage());
            $message = __('hanoivip::password.update.exception');
            $error = 999;
        }
        if ($request->ajax())
            return ['error'=>$error, 'message'=>$message];
        else
        {
            if (empty($error))
            {
                Auth::guard()->logout();
                $request->session()->invalidate();
            }
            return view('hanoivip::password-update-result', ['message' => $message, 'error' => $error]);
        }
    }
    
    public function personalInfo()
    {
        $uid = Auth::user()->id;
        $credential = $this->credentialMgr->getUserCredentials($uid);
        return view('hanoivip::personal-info', ['personal' => $credential]);
    }
    
    public function updatePersonalUI()
    {
        $sexs = [];
        for ($i=1; $i<6; $i++)
            $sexs[] = [ $i, __('hanoivip::credential.personal.sex' . $i) ];
        $cities = [];
        for ($i=1; $i<65; $i++)
            $cities[] = [ $i, __('hanoivip::credential.personal.city' . $i) ];
        $careers = [];
        for ($i=1; $i<10; $i++)
            $careers[] = [ $i, __('hanoivip::credential.personal.career' . $i) ];
        $marriages = [];
        for ($i=1; $i<4; $i++)
            $marriages[] = [ $i, __('hanoivip::credential.personal.marriage' . $i) ];
        $uid = Auth::user()->id;
        $credential = $this->credentialMgr->getUserCredentials($uid);
        return view('hanoivip::personal-update', [ 'personal' => $credential, 'cities' => $cities, 
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
                $message = __('hanoivip::personal.update.success');
            else
                $error_message = __('hanoivip::personal.update.fail');
            
        }
        catch (Exception $ex)
        {
            Log::error("Update personal exception. Msg: " . $ex->getMessage());
            $error_message = __('hanoivip::personal.update.exception');
        }
        return view('hanoivip::personal-update-result', ['message' => $message, 'error_message' => $error_message]);
    }
}

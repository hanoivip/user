<?php
namespace Hanoivip\User\Controllers;

use Hanoivip\User\Mail\UserOtp;
use Hanoivip\User\Services\TwofaService;
use Hanoivip\User\Services\DeviceService;
use Hanoivip\User\Services\CredentialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/**
 * Reset password with verification methods
 * New Flow to reset password
 * Client: User
 * @author gameo
 *
 */
class Forgot extends Controller
{
    protected $twofa;
    
    protected $devices;
    
    protected $users;
    
    public function __construct(
        TwofaService $twofa,
        DeviceService $devices,
        CredentialService $users)
    {
        $this->twofa = $twofa;
        $this->devices = $devices;
        $this->users = $users;
    }
    
    public function inputUsername(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('hanoivip::forgot-input-username');
        }
        else 
        {
            $username = $request->input('username');
            $record = $this->users->getUserCredentials($username);
            if (!empty($record))
            {
                return redirect()->route('forgot.otp', ['username' => $username]);
            }
            else 
            {
                return view('hanoivip::forgot-input-username', ['message' => __('hanoivip.user::twofa.user.not-exists')]);
                //return view('hanoivip::forgot-failure', ['message' => __('hanoivip.user::twofa.user.not-exists')]);
            }
        }
    }
    
    public function inputOtp(Request $request)
    {
        if ($request->has('way'))
            $way = $request->input('way');
        else
            $way = $this->twofa->getDefaultWay();
        $device = current_device();
        $username = $request->input('username');
        $record = $this->users->getUserCredentials($username);
        if (empty($record))
            abort(500, 'User not exists');
        $userId = $record->id;
        // UI
        $ways = $this->twofa->getUserWays($userId);
        if (empty($ways))
        {
            return view('hanoivip::forgot-failure', ['message' => __('hanoivip.user::twofa.user.no-way')]);
        }
        else
        {
            $this->twofa->startVerifyUser($userId, $way, $device);
            return view('hanoivip::forgot-input-otp', ['ways' => $ways, 'username' => $username, 'way' => $way]);
        }
    }
    
    public function checkOtp(Request $request)
    {
        if ($request->has('way'))
            $way = $request->input('way');
        else
            $way = $this->twofa->getDefaultWay();
        $device = current_device();
        $username = $request->input('username');
        $record = $this->users->getUserCredentials($username);
        if (empty($record))
            abort(500, 'User not exists');
            $userId = $record->id;
        $otp = $request->input('otp');
        $result = $this->twofa->verifyUser($userId, $device, $way, $otp);
        if ($result === true)
        {
            return redirect()->route('forgot.reset', ['otp' => $otp, 'way' => $way, 'username' => $username]);
        }
        else
        {
            $ways = $this->twofa->getUserWays($userId);
            return view('hanoivip::forgot-input-otp', 
                ['ways' => $ways, 'username' => $username, 'way' => $way,
                    'message' => __('hanoivip.user::twofa.otp-wrong')
                ]);
        }
    }
    
    public function resetPassword(Request $request)
    {
        $way = $request->input('way');
        $device = current_device();
        $otp = $request->input('otp');
        $username = $request->input('username');
        if ($request->isMethod('get'))
        {
            return view('hanoivip::forgot-input-password', 
                ['otp' => $otp, 'way' => $way, 'username' => $username]);
        }
        else
        {
            $password = $request->input('password');
            $record = $this->users->getUserCredentials($username);
            if (empty($record))
                abort(501, 'User not exists');
            $userId = $record->id;
            $result = $this->twofa->verifyUser($userId, $device, $way, $otp);
            if (empty($result))
                abort(502, 'OTP wrong');
            $result2 = $this->users->updatePass($userId, $password);
            if ($result2 === true)
            {
                return view('hanoivip::forgot-success');
            }
            else
            {
                return view('hanoivip::forgot-failure', ['message' => $result2]);
            }
        }
    }
}

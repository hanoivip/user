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
 * Client: App
 * @author gameo
 *
 */
class AppForgot extends Controller
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
    
    public function listWays(Request $request)
    {
        $username = $request->input('username');
        $record = $this->users->getUserCredentials($username);
        if (!empty($record))
        {
            $userId = $record->id;
            $ways = $this->twofa->getUserWays($userId);
            $list = [];
            foreach ($ways as $way => $detail)
            {
                $list[$way] = $detail->value;
            }
            if (!empty($ways))
            {
                return ['error' => 0, 'message' => 'success', 'data' => $list];
            }
            else
            {
                return ['error' => 2, 'message' => __('hanoivip::twofa.user.no-way'), 'data' => []];
            }
        }
        else
        {
            return ['error' => 1, 'message' => __('hanoivip::twofa.user.not-exists'), 'data' => []];
        }
    }
    
    public function verifyUser(Request $request)
    {
        $device = $request->get('device');
        $username = $request->input('username');
        $record = $this->users->getUserCredentials($username);
        if (empty($record))
            abort(501, 'User not exists');
        $userId = $record->id;
        $way = $request->input('way');
        $this->twofa->startVerifyUser($userId, $way, $device);
        return ['error' => 0, 'message' => 'success', 'data' => ''];
    }
    
    public function checkVerifyUser(Request $request)
    {
        $device = $request->get('device');
        $username = $request->input('username');
        $otp = $request->input('otp');
        $record = $this->users->getUserCredentials($username);
        if (empty($record))
            abort(501, 'User not exists');
        $userId = $record->id;
        $way = $request->input('way');
        $result = $this->twofa->verifyUser($userId, $device, $way, $otp);
        return ['error' => $result?0:1, 'message' => $result?'success':'failure'];
    }
    
    public function resetPassword(Request $request)
    {
        $device = $request->get('device');
        $username = $request->input('username');
        $otp = $request->input('otp');
        $record = $this->users->getUserCredentials($username);
        if (empty($record))
            abort(501, 'User not exists');
        $userId = $record->id;
        $way = $request->input('way');
        $result = $this->twofa->verifyUser($userId, $device, $way, $otp);
        if ($result === true)
        {
            $password = $request->input('password');
            $result2 = $this->users->updatePass($userId, $password);
            return ['error' => $result2?0:1, 'message' => $result2?'success':'failure'];
        }
        abort(501, 'Otp verification fail');
    }
    
}

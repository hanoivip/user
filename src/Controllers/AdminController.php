<?php

namespace Hanoivip\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Exception;
use Hanoivip\User\Facades\DeviceFacade;
use Hanoivip\User\Requests\AdminRequest;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\SecureService;
use Hanoivip\User\Services\OnlineService;
use Hanoivip\User\Notifications\SystemMessage;

class AdminController extends Controller
{
    const DEFAULT_PASSWORD = '12345678';
    
    protected $credentials;
    protected $secures;
    protected $onlines;
    
    public function __construct(
        CredentialService $credentials, 
        SecureService $secures,
        OnlineService $onlines)
    {
        $this->credentials = $credentials;
        $this->secures = $secures;
        $this->onlines = $onlines;
    }
    
    /**
     * Admin reset password for users
     * 1. Reset password with default value
     * 2. Logout user from all devices
     */
    public function resetPassword(AdminRequest $request)
    {
        $uid = $request->input('uid');
        try 
        {
            // Log admin actions
            $result = $this->credentials->updatePass($uid, self::DEFAULT_PASSWORD);
            if ($result === true)
            {
                // logout all
                return "ok";
            }
            else
                return $result;
        }
        catch (Exception $ex)
        {
            Log::error('Admin update user password exception:' . $ex->getMessage());
            abort(500);
        }
    }
    
    /**
     * Generate personal access token
     * 
     * @param AdminRequest $request
     */
    public function generateToken(AdminRequest $request)
    {
        $uid = $request->input('uid');
        try
        {
            $token = Str::random(32);
            $device = $request->get('device');
            DeviceFacade::mapUserDevice($device, $uid, $token);
            return $token;
        }
        catch (Exception $ex)
        {
            Log::error('Admin generate user token exception:' . $ex->getMessage());
            abort(500);
        }
        abort(404);
    }
    
    public function generateToken1(AdminRequest $request)
    {
        $uid = $request->input('uid');
        try
        {
            $user = $this->credentials->getUserCredentials($uid);
            if (!empty($user))
            {
                $apiToken = $user->api_token;
                if (empty($apiToken))
                {
                    $apiToken = Str::random(16);
                    $user->api_token = $apiToken;
                    $user->save();
                    
                }
                return $apiToken;
            }
        }
        catch (Exception $ex)
        {
            Log::error('Admin generate user token exception:' . $ex->getMessage());
            abort(500);
        }
        abort(404);
    }
    
    public function userInfo(AdminRequest $request)
    {
        $uid = $request->input('uid');
        try
        {
            $user = $this->credentials->getUserCredentials($uid);
            if (!empty($user))
            {
                $secure = $this->secures->getInfo($user->id);
                return ['id' => $user->id, 'personal' => $user, 'secure' => $secure];
            }
        }
        catch (Exception $ex)
        {
            Log::error('Admin get user info exception:' . $ex->getMessage());
            abort(500);
        }
        abort(404, "User not found");
    }
    
    public function broadcast(Request $request)
    {
        $message = "";
        $errorMessage = "";
        if ($request->getMethod() == 'POST')
        {
            try
            {
                $broadcast = $request->input('broadcast');
                $users = $this->onlines->getCurrentLogins();
                Notification::send($users, new SystemMessage($broadcast));
                $message = "Broadcast system message ok!";
            }
            catch (Exception $ex)
            {
                Log::error("Broadcast err:" . $ex->getMessage());
                $errorMessage = "Broadcast exception";
            }
        }
        if ($request->expectsJson())
        {
            return ['error' => 0, 'message' => $message, 'error_message' => $errorMessage];    
        }
        else
        {
            return view('hanoivip::admin.broadcast', ['message' => $message, 'error_message' => $errorMessage]);
        }
    }
}

<?php

namespace Hanoivip\User\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;
use Hanoivip\User\Facades\DeviceFacade;
use Hanoivip\User\Requests\AdminRequest;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\SecureService;

class AdminController extends Controller
{
    const DEFAULT_PASSWORD = '12345678';
    
    protected $credentials;
    
    protected $secures;
    
    public function __construct(
        CredentialService $credentials, SecureService $secures)
    {
        $this->credentials = $credentials;
        $this->secures = $secures;
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
}

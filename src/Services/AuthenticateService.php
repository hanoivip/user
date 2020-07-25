<?php

namespace Hanoivip\User\Services;

use Hanoivip\User\PasswordReset;
use Illuminate\Support\Facades\Log;

class AuthenticateService
{
    public function createUser($usernameOrEmailOrMobile, $password)
    {
        
    }
    
    public function logout($token)
    {
        Log::debug('Logout single device, token=' . $token);
    }
    
    public function logoutAllDevices()
    {
        Log::debug('Logout all devices');
    }

}
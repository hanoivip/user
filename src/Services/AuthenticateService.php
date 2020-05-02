<?php

namespace Hanoivip\User\Services;

use Illuminate\Support\Facades\Log;

class AuthenticateService
{
    public function logout($token)
    {
        Log::debug('Logout single device, token=' . $token);
    }
    
    public function logoutAllDevices()
    {
        Log::debug('Logout all devices');
    }
}
<?php 

use Hanoivip\User\Facades\DeviceFacade;
use Illuminate\Support\Facades\Auth;

if (! function_exists('current_device')) 
{
    function current_device()
    {
        return request()->get('device');
    }
}

if (! function_exists('current_device_token'))
{
    function current_user_device_token()
    {
        if (Auth::check())
        {
            $deviceId = request()->get('device')->deviceId;
            $userId = Auth::user()->getAuthIdentifier();
            $device = DeviceFacade::getUserDeviceAll($userId, $deviceId);
            return $device->api_token;
        }
        return "";
    }
}
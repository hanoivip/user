<?php 

use Hanoivip\User\Facades\DeviceFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
            if (!empty($deviceId))
            {
                $userId = Auth::user()->getAuthIdentifier();
                $device = DeviceFacade::getUserDeviceAll($userId, $deviceId);
                if (!empty($device)) return $device->api_token;
            }
            Auth::logout();
            Request::session()->invalidate();
        }
        return "";
    }
}
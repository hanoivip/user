<?php 

use Hanoivip\User\Facades\DeviceFacade;

if (! function_exists('current_device')) 
{
    function current_device()
    {
        return request()->get('device');
    }
}

if (! function_exists('current_device_token'))
{
    function current_device_token()
    {
        return DeviceFacade::getToken(request()->get('device'));
    }
}
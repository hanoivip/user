<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Closure;
use Jenssegers\Agent\Agent;
use Hanoivip\User\Device;

class DeviceInfo
{   
    protected $encrypter;
    
    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $key = "us-device-id";
        $deviceId = '';
        $deviceIp = $request->getClientIp();
        $agent = new Agent();
        if ($request->ajax())
        {
            $deviceId = $request->headers->get('us-device-id');
            $deviceOs = $request->headers->get('us-device-os');
            $deviceOsVer = $request->headers->get('us-device-os-ver');
            $deviceName = $agent->device();
            $deviceVer = $agent->version($deviceName);
        }
        else 
        {
            if (Cookie::has($key))
                $deviceId = $this->encrypter->decrypt(Cookie::get($key), false);
            $deviceOs = $agent->platform();
            $deviceOsVer = $agent->version($deviceOs);
            $deviceName = $agent->browser();
            $deviceVer = $agent->version($deviceName);
        }
        $info = new Device();
        $info->deviceId = $deviceId;
        $info->deviceIp = $deviceIp;
        $info->deviceOs = $deviceOs;
        $info->deviceOsVer = $deviceOsVer;
        $info->deviceName = $deviceName;
        $info->deviceVer = $deviceVer;
        //Log::debug(print_r($info, true));
        $request->attributes->add(['device' => $info]);
        return $next($request);
    }
}

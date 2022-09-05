<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Closure;
use Jenssegers\Agent\Agent;
use Hanoivip\User\Device;
use Hanoivip\User\Services\DeviceService;

class DeviceInfo
{   
    protected $encrypter;
    
    protected $devices;
    
    public function __construct(
        Encrypter $encrypter, 
        DeviceService $devices)
    {
        $this->encrypter = $encrypter;
        $this->devices = $devices;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $key = 'us-device-id';
        $deviceId = '';
        $deviceIp = $request->getClientIp();
        $agent = new Agent();
        if ($request->ajax())
        {
            $deviceId = $this->tryGetValue($request, 'us-device-id');
            $deviceOs = $this->tryGetValue($request, 'us-device-os');
            $deviceOsVer = $this->tryGetValue($request, 'us-device-os-ver');
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
    
    protected function tryGetValue(Request $request, $key)
    {
        if (Cookie::has($key))
            return $this->encrypter->decrypt(Cookie::get($key), false);
        if ($request->headers->has($key))
            return $request->headers->get($key);
        Log::error("DeviceInfo fail to retrieve $key");
        return null;
    }
}

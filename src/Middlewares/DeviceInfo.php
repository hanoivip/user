<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Closure;
use Jenssegers\Agent\Agent;
use Hanoivip\User\Device;
use Hanoivip\User\Services\DeviceService;

class DeviceInfo
{   
    const DEVICE_ID_KEY = 'us-device-id';
    
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
            $deviceId = $this->tryGetValue($request, 'us-device-id');
            if (empty($deviceId))
            {
                $deviceId = $this->generateDeviceId();
            }
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
    
    protected function generateDeviceId()
    {
        $deviceId = Str::random();
        Cookie::queue(Cookie::make(self::DEVICE_ID_KEY, $deviceId, 365 * 24 * 60));
        return $deviceId;
    }
}

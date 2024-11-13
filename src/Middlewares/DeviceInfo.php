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
/**
 * Get device detail info
 * Assign ID if need
 * @author GameOH
 *
 */
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
    
    private function getDeviceId() {
        
    }
    
    public function handle(Request $request, Closure $next)
    {
        $key =  config('id.device-id-key', self::DEVICE_ID_KEY);
        $deviceId = '';
        $deviceIp = $this->tryGetIp($request);
        $agent = new Agent();
        if ($request->ajax())
        {
            $deviceId = $this->tryGetValue($request, $key);
            $deviceOs = $this->tryGetValue($request, 'us-device-os');
            $deviceOsVer = $this->tryGetValue($request, 'us-device-os-ver');
            $deviceName = $agent->device();
            $deviceVer = $agent->version($deviceName);
        }
        else 
        {
            $deviceId = $this->tryGetValue($request, $key);
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
    
    protected function tryGetIp(Request $request)
    {
        $ip = $request->headers->get('CF-Connecting-IP');
        if (empty($ip))
        {
            $ip = $request->headers->get('X-Real-IP');
        }
        if (empty($ip))
            $ip = $request->getClientIp();
        return $ip;
    }
    
    protected function tryGetValue(Request $request, $key)
    {
        if (Cookie::has($key))
            return $this->encrypter->decrypt(Cookie::get($key), false);
        if ($request->headers->has($key))
            return $request->headers->get($key);
        if ($request->has($key))
            return $request->input($key);
        return null;
    }
    
    protected function generateDeviceId()
    {
        $key =  config('id.device-id-key', self::DEVICE_ID_KEY);
        $deviceId = Str::random();
        Cookie::queue(Cookie::make($key, $deviceId, 365 * 24 * 60));
        return $deviceId;
    }
}

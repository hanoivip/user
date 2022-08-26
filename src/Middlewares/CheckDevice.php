<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;
use Hanoivip\User\Services\TwofaService;
use Hanoivip\User\Services\DeviceService;

class CheckDevice
{
    private $twofa;
    
    private $devices;
    
    const VERIFY_ROUTE = 'twofa.verify';
    
    protected $except = [
        '/user/verify',
        '/user/verify/do',
        '/logout',
    ];
    
    public function __construct(
        TwofaService $twofa,
        DeviceService $devices)
    {
        $this->twofa = $twofa;
        $this->devices = $devices;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $device = $request->get('device');
        if (!empty($device))
        {
            //Log::debug(print_r($device, true));
            $this->devices->logDevice($device);
        }
        if (Auth::check())
        {
            $userId = Auth::user()->getAuthIdentifier();
            $uri = $request->getRequestUri();
            //Log::debug("checking .. $uri");
            if (!in_array($uri, $this->except))
            {
                if (empty($device) &&
                    $this->twofa->getStatus($userId))
                {
                    return abort(400, 'Device need verify');
                }
                if (!empty($device) &&
                    $this->twofa->getStatus($userId) &&
                    $this->twofa->needVerifyDevice($userId, $device))
                    return response()->redirectToRoute(self::VERIFY_ROUTE);
            }
        }
        return $next($request);
    }
}

<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;
use Hanoivip\User\Services\TwofaService;
use Hanoivip\User\Mail\TwofaStrangeDevice;

class CheckDevice
{
    private $twofa;
    
    const VERIFY_ROUTE = 'twofa.verify';
    
    protected $except = [
        '/user/verify',
        '/user/verify/do'
    ];
    
    public function __construct(TwofaService $twofa)
    {
        $this->twofa = $twofa;
    }
    
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            $uri = $request->getRequestUri();
            //Log::debug("checking .. $uri");
            if (!in_array($uri, $this->except))
            {
                $userId = Auth::user()->getAuthIdentifier();
                $device = $request->get('device');
                //Log::debug(print_r($device, true));
                if (empty($device) &&
                    $this->twofa->getStatus($userId))
                {
                    return abort(400, 'Device need verify');
                }
                if (!empty($device) &&
                    $this->twofa->needVerifyDevice($userId, $device))
                {
                    if ($this->twofa->getStatus($userId))
                        return response()->redirectToRoute(self::VERIFY_ROUTE);
                    else 
                        $this->twofa->forceTrustDevice($userId, $device);
                }
            }
        }
        return $next($request);
    }
}

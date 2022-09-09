<?php

namespace Hanoivip\User\Middlewares;

use Hanoivip\User\Services\TwofaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;

class CheckDevice
{
    private $twofa;
    
    
    const VERIFY_ROUTE = 'twofa.verify';
    
    protected $except = [
        '/user/verify',
        '/user/verify/do',
        '/logout',
    ];
    
    public function __construct(
        TwofaService $twofa)
    {
        $this->twofa = $twofa;
    }
    
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            $userId = Auth::user()->getAuthIdentifier();
            $device = $request->get('device');
            $uri = $request->getRequestUri();
            Log::debug("checking .. $uri");
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

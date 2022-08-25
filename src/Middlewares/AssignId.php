<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Closure;

class AssignId
{
    protected $encrypter;
    
    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $key = 'us-device-id';
        if (Cookie::has($key))
        {
            $deviceId = $this->encrypter->decrypt(Cookie::get($key), false);
            //Log::debug("Already assigned id $deviceId");
        }
        else
        {
            $deviceId = Str::random();
            Cookie::queue(Cookie::make($key, $deviceId, 365 * 24 * 60));
            //Log::debug("Assigned new id $deviceId");
        }
        return $next($request);
    }
}

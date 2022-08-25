<?php

namespace Hanoivip\User\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Closure;

class Relogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            $key = 'LastLogin_' . Auth::user()->getAuthIdentifier();
            $interval = 120;//s
            if (Cache::has($key) &&
                Carbon::now()->diffInSeconds(Cache::get($key)) > $interval)
            {
                Auth::logout();
                $current = $request->getRequestUri();
                return response()->redirectToRoute('login', ['redirect' => $current]);
            }
            else
            {
                Log::debug("Relogin middeware .. " . Carbon::now()->timestamp . " & " . Cache::get($key)->timestamp);
            }
        }
        return $next($request);
    }
}

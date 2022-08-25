<?php

namespace Hanoivip\User\Middlewares;

use Hanoivip\User\Services\OtpService;
use Illuminate\Http\Request;
use Closure;

class CheckOtp
{
    protected $otp;
    
    public function __construct(OtpService $otp)
    {
        $this->otp = $otp;
    }
    
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('otp'))
        {
            $otp = $request->input('otp');
            $result = $this->otp->check($otp);
            if ($result == true)
                return $next($request);
            return response()->redirectTo($request->getUri())->withErrors(['otp' => $result]);
        }
    }
}

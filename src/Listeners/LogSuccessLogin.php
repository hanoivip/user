<?php

namespace Hanoivip\User\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class LogSuccessLogin
{
    public function handle(Login $event)
    {
        $userId = $event->user->getAuthIdentifier();
        Cache::put('LastLogin_' . $userId, Carbon::now());
    }
}
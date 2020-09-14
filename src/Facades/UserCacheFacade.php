<?php

namespace Hanoivip\User\Facades;

use Illuminate\Support\Facades\Facade;

class UserCacheFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userCacheService';
    }
}

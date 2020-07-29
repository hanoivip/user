<?php

namespace Hanoivip\User\Facades;

use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CredentialService';
    }
}

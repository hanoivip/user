<?php

namespace Hanoivip\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Hanoivip\User\User getUserCredentials($uidOrUsername)
 *
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CredentialService';
    }
}

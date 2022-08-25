<?php

namespace Hanoivip\User\Facades;

use Illuminate\Support\Facades\Facade;

class DeviceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DeviceService';
    }
}

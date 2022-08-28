<?php

namespace Hanoivip\User\Facades;

use Illuminate\Support\Facades\Facade;

class TwofaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TwofaService';
    }
}

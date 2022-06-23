<?php

namespace Hanoivip\User;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Hanoivip\Events\Gate\UserTopup' => [
        ],
        'Hanovip\Events\Payment\TransactionUpdated' => [
        ]
    ];
    
    public function boot()
    {
        parent::boot();
    }
}
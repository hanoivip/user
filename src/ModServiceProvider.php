<?php
namespace Hanoivip\User;

use Illuminate\Support\ServiceProvider;
use Hanoivip\User\Services\CacheService;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\DeviceService;
use Hanoivip\User\Services\TwofaService;

class ModServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../views' => resource_path('views/vendor/hanoivip'),
            __DIR__ . '/../lang' => resource_path('lang/vendor/hanoivip'),
            __DIR__ . '/../config' => config_path(),
            __DIR__ . '/../resources' => public_path()
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../views', 'hanoivip');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadTranslationsFrom(__DIR__ . '/../lang/', 'hanoivip');
        $this->mergeConfigFrom(__DIR__ . '/../config/id.php', 'id');
    }

    public function register()
    {
        $this->commands([]);
        $this->app->bind('CredentialService', CredentialService::class);
        $this->app->bind('userCacheService', CacheService::class);
        $this->app->bind('DeviceService', DeviceService::class);
        $this->app->bind('TwofaService', TwofaService::class);
    }
}

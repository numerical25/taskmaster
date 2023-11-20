<?php

namespace App\Providers;

use App\Services\CryptoService;
use Illuminate\Support\ServiceProvider;

class CryptoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('CryptoService', function ($app) {
            return new CryptoService();
        });
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

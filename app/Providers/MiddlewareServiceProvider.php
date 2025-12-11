<?php

namespace App\Providers;

use App\Http\Middleware\LogUserActivity;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register middleware global
        $kernel = $this->app->make(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', LogUserActivity::class);
        $kernel->appendMiddlewareToGroup('api', LogUserActivity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

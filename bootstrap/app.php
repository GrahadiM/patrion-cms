<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\LogUserActivity;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register middleware global untuk web dan api
        $middleware->appendToGroup('web', [
            LogUserActivity::class,
        ]);

        $middleware->appendToGroup('api', [
            LogUserActivity::class,
        ]);

        // Atau jika ingin middleware hanya untuk route tertentu
        $middleware->alias([
            'log.activity' => LogUserActivity::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

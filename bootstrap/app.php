<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust Render's proxy to detect HTTPS correctly
        $middleware->trustProxies(at: '*');
        // Force HTTPS scheme when behind proxy
        $middleware->trustHosts(at: ['*']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

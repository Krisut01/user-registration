<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS for asset URLs when APP_URL is HTTPS (for Render/proxy environments)
        if (config('app.url') && str_starts_with(config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        
        // Performance optimization: eager load user count
        \App\Models\User::observe(new class {
            public function retrieved($model) {
                // Cache user count when users are accessed
                if (!\Illuminate\Support\Facades\Cache::has('user_count')) {
                    \Illuminate\Support\Facades\Cache::put('user_count', \App\Models\User::count(), 300);
                }
            }
        });
    }
}

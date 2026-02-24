<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\AdminNotificationComposer;
use Illuminate\Support\Facades\URL;

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
    public function boot(): void { View::composer('layouts.navigation', AdminNotificationComposer::class); // Force HTTPS en production if (config('app.env') === 'production') { URL::forceScheme('https'); } }
}
}
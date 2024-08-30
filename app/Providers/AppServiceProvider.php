<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Register your broadcast channels
        Broadcast::channel('screenings', function ($user) {
            return true; // Atau tambahkan logika autentikasi tambahan jika diperlukan
        });
    }
}

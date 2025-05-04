<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator; // Tambahkan import ini
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // Tambahkan import ini

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
        Paginator::useTailwind(); // Menggunakan Tailwind untuk pagination
        Gate::define('admin', function ($user) {
            return $user->is_admin == true; // Mengecek apakah user adalah admin
        });
    }
}

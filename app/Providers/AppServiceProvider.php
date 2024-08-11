<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        'App\Models\Book' => 'App\Policies\BookPolicy',
    ];
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

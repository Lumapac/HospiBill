<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register DomPDF
        $this->app->bind('dompdf', function() {
            return new \Dompdf\Dompdf();
        });
        
        $this->app->bind('dompdf.pdf', function() {
            return new \Barryvdh\DomPDF\PDF($this->app->make('dompdf'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set default string length for database migrations
        Schema::defaultStringLength(191);
    }
}

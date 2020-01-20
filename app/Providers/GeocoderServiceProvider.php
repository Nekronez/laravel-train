<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;


class GeocoderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('geocoderProvider', 'App\Services\GeocoderProvider');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}

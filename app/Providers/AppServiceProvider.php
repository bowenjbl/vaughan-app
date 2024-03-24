<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind('urlshortener', function($app){
            $shortener = 'tiny_url';
            return new \App\Managers\UrlShortener($app, $shortener);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use FeedIo\FeedIo;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FeedIo::class, function () {
            $client = new \FeedIo\Adapter\Http\Client(new Client());
            return new FeedIo($client);
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

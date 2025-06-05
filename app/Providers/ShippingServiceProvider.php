<?php

namespace App\Providers;

use App\Shipping\Adapters\EloquentShippingServiceAdapter;
use App\Shipping\Factories\ShippingServiceFactory;
use App\Shipping\ShippingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class ShippingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentShippingServiceAdapter::class, function () {
            return new EloquentShippingServiceAdapter();
        });

        $this->app->bind(ShippingServiceFactory::class, function (Application $app) {
            return new ShippingServiceFactory($app, config('shipping'));
        });

        $this->app->bind(ShippingService::class, function (Application $app) {
            $factory = $app->get(ShippingServiceFactory::class);

            return $factory->make();
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

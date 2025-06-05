<?php

namespace App\Shipping\Factories;

use App\Shipping\Contracts\ShippingServiceProviderInterface;
use App\Shipping\Provider\MockShippingServiceProvider;
use App\Shipping\ShippingService;
use Illuminate\Contracts\Foundation\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use LogicException;

class ShippingServiceFactory
{
    private array $providers = [
        'mock' => MockShippingServiceProvider::class,
    ];

    public function __construct(
        private readonly Application $app,
        private readonly array $config
    ) { }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function make(): ShippingService
    {
        $providerName = $this->config['service']['provider'] ?? null;

        if (isset($this->providers[$providerName])) {
            $provider = $this->app->get($this->providers[$providerName]);

            if (! $provider instanceof ShippingServiceProviderInterface) {
                throw new LogicException("Provide $providerName does not implement ShippingServiceProviderInterface");
            }

            return new ShippingService($provider);
        }

        throw new LogicException('Not implemented');
    }
}

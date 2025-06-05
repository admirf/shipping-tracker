<?php

namespace App\Shipping\Factories;

use App\Shipping\Contracts\ShippingServiceDriverInterface;
use App\Shipping\Adapters\MockShippingServiceAdapter;
use App\Shipping\ShippingService;
use Illuminate\Contracts\Foundation\Application;
use Psr\Container\ContainerExceptionInterface;
use LogicException;

// Could've been done directly in shipping service provider,
// but I personally like delegating instantiation logic to its own class for a more rigid system
class ShippingServiceFactory
{
    public const PROVIDER_MOCK = 'mock';

    private array $providers = [
        self::PROVIDER_MOCK => MockShippingServiceAdapter::class,
    ];

    public function __construct(
        private readonly Application $app,
        private readonly array $config
    ) { }

    /**
     * @throws ContainerExceptionInterface
     */
    public function make(): ShippingService
    {
        $providerName = $this->config['service']['provider'] ?? null;

        if (isset($this->providers[$providerName])) {
            $provider = $this->app->get($this->providers[$providerName]);

            if (! $provider instanceof ShippingServiceDriverInterface) {
                throw new LogicException("Provide $providerName does not implement ShippingServiceDriverInterface");
            }

            return new ShippingService($provider);
        }

        throw new LogicException('Not implemented');
    }
}

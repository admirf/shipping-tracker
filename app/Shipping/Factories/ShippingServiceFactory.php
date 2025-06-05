<?php

namespace App\Shipping\Factories;

use App\Shipping\Adapters\CsvShippingServiceAdapter;
use App\Shipping\Adapters\EloquentShippingServiceAdapter;
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
    public const PROVIDER_ELOQUENT = 'eloquent';
    public const PROVIDER_CSV = 'csv';

    private array $providers = [
        self::PROVIDER_MOCK => MockShippingServiceAdapter::class,
        self::PROVIDER_ELOQUENT => EloquentShippingServiceAdapter::class,
        self::PROVIDER_CSV => CsvShippingServiceAdapter::class,
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

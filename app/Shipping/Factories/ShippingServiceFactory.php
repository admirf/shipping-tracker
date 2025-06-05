<?php

namespace App\Shipping\Factories;

use App\Shipping\ShippingService;
use Illuminate\Contracts\Foundation\Application;

class ShippingServiceFactory
{
    private $providers = [

    ];

    public function __construct(
        private readonly Application $app,
        private readonly array $config
    ) { }

    public function make(): ShippingService
    {
        throw new \LogicException('Not implemented');
    }
}

<?php

namespace App\Shipping\Factories;

use App\Shipping\ShippingService;

class ShippingServiceFactory
{
    private $providers = [

    ];

    public function __construct(private readonly array $config) { }

    public function make(): ShippingService
    {
        throw new \LogicException('Not implemented');
    }
}

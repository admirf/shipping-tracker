<?php

namespace Tests\Unit;

use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Exceptions\ShipmentNotFoundException;
use App\Shipping\Factories\ShippingServiceFactory;
use App\Shipping\Provider\MockShippingServiceProvider;
use App\Shipping\ShippingService;
use Tests\TestCase;

class ShippingServiceTest extends TestCase
{
    public function testService(): void
    {
        // test instantiation
        $this->app->instance(MockShippingServiceProvider::class, new MockShippingServiceProvider());

        $shippingServiceFactory = new ShippingServiceFactory($this->app, [
            'service' => [
                'provider' => ShippingServiceFactory::PROVIDER_MOCK
            ]
        ]);

        $this->assertInstanceOf(ShippingServiceFactory::class, $shippingServiceFactory);

        $shippingService = $shippingServiceFactory->make();

        $this->assertInstanceOf(ShippingService::class, $shippingService);

        // test success
        $trackingCode = '000000';

        $shipment = $shippingService->findShipmentByTrackingCode($trackingCode);

        $this->assertInstanceOf(ShippableInterface::class, $shipment);

        // test exception

        try {
            $shippingService->findShipmentByTrackingCode('giberish');
        } catch (\Throwable $e) {
            $this->assertInstanceOf(ShipmentNotFoundException::class, $e);
            $this->assertEquals('Shipment not found', $e->getMessage());
        }
    }
}

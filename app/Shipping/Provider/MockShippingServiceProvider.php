<?php

namespace App\Shipping\Provider;

use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Contracts\ShippingServiceProviderInterface;
use App\Shipping\Shipments\SimpleShipment;

class MockShippingServiceProvider implements ShippingServiceProviderInterface
{
    public function getShipmentByTrackingCode(string $trackingCode): ?ShippableInterface
    {
        // simple test case
        if ($trackingCode === '000000') {
            return new SimpleShipment($trackingCode, now()->addDays(7)->toDateTimeImmutable());
        }

        return null;
    }
}

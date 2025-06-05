<?php

namespace App\Shipping\Adapters;

use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Contracts\ShippingServiceDriverInterface;
use App\Shipping\Shipments\SimpleShipment;

class MockShippingServiceAdapter implements ShippingServiceDriverInterface
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

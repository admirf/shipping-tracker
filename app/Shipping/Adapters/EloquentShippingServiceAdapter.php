<?php

namespace App\Shipping\Adapters;

use App\Models\Shipment;
use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Contracts\ShippingServiceDriverInterface;

class EloquentShippingServiceAdapter implements ShippingServiceDriverInterface
{
    public function getShipmentByTrackingCode(string $trackingCode): ?ShippableInterface
    {
        return Shipment::query()
            ->where('tracking_code', $trackingCode)
            ->first();
    }
}

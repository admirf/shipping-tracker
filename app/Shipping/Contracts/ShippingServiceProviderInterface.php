<?php

namespace App\Shipping\Contracts;

interface ShippingServiceProviderInterface
{
    public function getShipmentByTrackingCode(string $trackingCode): ?ShippableInterface;
}

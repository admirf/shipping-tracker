<?php

namespace App\Shipping\Contracts;

interface ShippingServiceDriverInterface
{
    public function getShipmentByTrackingCode(string $trackingCode): ?ShippableInterface;
}

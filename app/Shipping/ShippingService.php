<?php

namespace App\Shipping;

use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Contracts\ShippingServiceDriverInterface;
use App\Shipping\Exceptions\ShipmentNotFoundException;
use Illuminate\Support\Facades\Cache;

readonly class ShippingService
{
    public function __construct(
        private ShippingServiceDriverInterface $driver,
        private string $cachePrefix,
        private int $cacheTtl
    ) { }

    /**
     * @throws ShipmentNotFoundException
     */
    public function findShipmentByTrackingCode(string $trackingCode): ShippableInterface
    {
        // in real world application we would use caching
        // how long we cache depends on our available caching service

        $shipment = Cache::remember($this->cacheKey($trackingCode), $this->cacheTtl, function () use ($trackingCode) {
            return $this->driver->getShipmentByTrackingCode($trackingCode);
        });

        if (is_null($shipment)) {
            throw new ShipmentNotFoundException();
        }

        return $shipment;
    }

    protected function cacheKey(string $trackingCode): string
    {
        return $this->cachePrefix . $trackingCode;
    }
}

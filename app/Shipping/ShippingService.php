<?php

namespace App\Shipping;

use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Contracts\ShippingServiceProviderInterface;
use App\Shipping\Exceptions\ShipmentNotFoundException;

readonly class ShippingService
{
    public function __construct(private ShippingServiceProviderInterface $driver) { }

    /**
     * @throws ShipmentNotFoundException
     */
    public function findShipmentByTrackingCode(string $trackingCode): ShippableInterface
    {
        $shipment = $this->driver->getShipmentByTrackingCode($trackingCode);

        if (is_null($shipment)) {
            throw new ShipmentNotFoundException();
        }

        return $shipment;
    }
}

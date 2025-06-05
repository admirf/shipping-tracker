<?php

namespace App\Shipping\Shipments;

use App\Shipping\Contracts\ShippableInterface;
use DateTimeImmutable;

readonly class SimpleShipment implements ShippableInterface
{
    public function __construct(private string $trackingCode, private DateTimeImmutable $date) { }

    public function getTrackingCode(): string
    {
        return $this->trackingCode;
    }

    public function getEstimatedDeliveryDate(): DateTimeImmutable
    {
        return $this->date;
    }
}

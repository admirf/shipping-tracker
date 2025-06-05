<?php

namespace App\Shipping\Contracts;

use DateTimeImmutable;

interface ShippableInterface
{
    public function getTrackingCode(): string;
    public function getEstimatedDeliveryDate(): DateTimeImmutable;
}

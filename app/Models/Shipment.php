<?php

namespace App\Models;

use App\Shipping\Contracts\ShippableInterface;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string tracking_code
 * @property Carbon expected_delivery_at
 */
class Shipment extends Model implements ShippableInterface
{
    protected $fillable = [
        'tracking_code',
        'expected_delivery_at',
    ];

    protected $casts = [
        'expected_delivery_at' => 'datetime',
    ];

    public function getTrackingCode(): string
    {
        return $this->tracking_code;
    }

    public function getEstimatedDeliveryDate(): DateTimeImmutable
    {
        return $this->expected_delivery_at->toDateTimeImmutable();
    }
}

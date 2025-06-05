<?php

namespace App\Http\Resources;

use App\Shipping\Contracts\ShippableInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // I like typehints

        /** @var ShippableInterface $shipment */
        $shipment = $this->resource;

        return [
            'tracking_code' => $shipment->getTrackingCode(),
            'expected_delivery_at' => $shipment
                ->getEstimatedDeliveryDate()
                ->format('Y-m-d H:i:s'),
        ];
    }
}

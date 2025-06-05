<?php

namespace App\Http\Controllers\Api\V1\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShipmentResource;
use App\Shipping\Exceptions\ShipmentNotFoundException;
use App\Shipping\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * @throws ShipmentNotFoundException
     */
    public function show(ShippingService $shippingService, string $trackingCode): ShipmentResource
    {
        $shipment = $shippingService->findShipmentByTrackingCode($trackingCode);

        return new ShipmentResource($shipment);
    }
}

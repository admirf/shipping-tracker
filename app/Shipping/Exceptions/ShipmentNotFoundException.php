<?php

namespace App\Shipping\Exceptions;

use Exception;

class ShipmentNotFoundException extends Exception
{
    protected $message = 'Shipment not found';
}

<?php

use App\Http\Controllers\Api\V1\Home\WelcomeController;
use App\Http\Controllers\Api\V1\Shipping\ShippingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/', WelcomeController::class);

    // I personally prefer controller grouping and writing routes manually
    Route::controller(ShippingController::class)->group(function () {
        Route::get('/shipping/{trackingCode}', 'show')->name('shipping.show');
    });
});

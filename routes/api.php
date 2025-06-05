<?php

use App\Http\Controllers\Api\V1\Home\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/', WelcomeController::class);
});

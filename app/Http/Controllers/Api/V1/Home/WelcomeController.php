<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class WelcomeController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return Response::json([
            'message' => 'Welcome to Shipping Tracker Api V1'
        ]);
    }
}

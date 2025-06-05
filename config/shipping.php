<?php

return [
    'service' => [
        'provider' => env('SHIPPING_PROVIDER', 'eloquent'),
        'cache_prefix' => 'shipping_service_',
        'cache_ttl' => 3600,
    ],
    'csv' => [
        'path' => 'csv/tracking_codes.csv'
    ]
];

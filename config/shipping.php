<?php

return [
    'service' => [
        'provider' => env('SHIPPING_PROVIDER', 'eloquent'),
    ],
    'csv' => [
        'path' => 'csv/tracking_codes.csv'
    ]
];

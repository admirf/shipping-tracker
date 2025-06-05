<?php

namespace Database\Seeders;

use App\Models\Shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add some dummy data
        Shipment::query()->create([
            'tracking_code' => '1234567890',
            'expected_delivery_at' => now()->addWeek(),
        ]);

        Shipment::query()->create([
            'tracking_code' => '0000000000',
            'expected_delivery_at' => now()->addWeek(),
        ]);
    }
}

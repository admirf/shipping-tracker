<?php

namespace Tests\Feature;

use App\Models\Shipment;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingTest extends TestCase
{
    use InteractsWithDatabase, RefreshDatabase, InteractsWithContainer;

    private const TRACKING_CODE = '1234567890';

    public function setUp(): void
    {
        parent::setUp();

        Shipment::query()->create([
            'tracking_code' => self::TRACKING_CODE,
            'expected_delivery_at' => now()->addWeek()
        ]);
    }

    public function testShippingCsvShow(): void
    {
        $this->testShippingShow('csv');
    }

    public function testShippingEloquentShow(): void
    {
        $this->testShippingShow('eloquent');
    }

    protected function testShippingShow(string $provider): void
    {
        config('shipping.service.provider', $provider);

        $response = $this->get('/api/v1/shipping/' . self::TRACKING_CODE);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'tracking_code',
                'expected_delivery_at',
            ]
        ]);

        $response = $this->get('/api/v1/shipping/gibberish');
        $response->assertStatus(404);
    }
}

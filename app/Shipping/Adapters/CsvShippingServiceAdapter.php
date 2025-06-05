<?php

namespace App\Shipping\Adapters;

use App\Shipping\Contracts\ShippableInterface;
use App\Shipping\Contracts\ShippingServiceDriverInterface;
use App\Shipping\Shipments\SimpleShipment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * In the real world, if we were to use csv as storage we would do different approach
 * Its safe to assume with deliveries and shipments that it is not that write intensive
 * but more read intensive, as users check their tracking more than they order.
 * So the smart way would be to keep the csv list sorted by tracking_code,
 * so that we can leverage binary search once the CSV is read,
 * but then again we wouldn't use csv for a larger scale solution
 */
readonly class CsvShippingServiceAdapter implements ShippingServiceDriverInterface
{
    public function __construct(private array $config) { }

    public function getShipmentByTrackingCode(string $trackingCode): ?ShippableInterface
    {
        $path = $this->config['path'];

        $content = Storage::get($path);
        //dd($content);

        $data = $this->parseData($content);

        //dd($data);

        $record = $data->firstWhere('tracking_code', $trackingCode);

        if (! $record) {
            return null;
        }

        return new SimpleShipment(
            $record['tracking_code'],
            Carbon::parse($record['expected_delivery_at'])->toDateTimeImmutable()
        );
    }

    private function parseData(string $content): Collection
    {
        // split by new line
        $lines = explode(PHP_EOL, $content);

        // extract header
        $header = collect(str_getcsv(array_shift($lines)));

        // convert data into collection
        $rows = collect($lines);

        // combine headers to have keys
        return $rows->map(fn($row) => $header->combine(str_getcsv($row)));
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateCsv extends Command
{
    private array $sampleTrackingCodes = [
        '0000000000',
        '1234567890'
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate csv file containing dummy data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $content = "tracking_code,expected_delivery_at\n";

        foreach ($this->sampleTrackingCodes as $trackingCode) {
            $expected_delivery_at = now()->addWeek()->format('Y-m-d H:i:s');

            $content .= "$trackingCode,$expected_delivery_at\n";
        }

        Storage::put(config('shipping.csv.path'), $content);
    }
}

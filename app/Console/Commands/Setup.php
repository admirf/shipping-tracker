<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs a fresh instance of the app';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('app:generate-csv');
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\PerformEndpointCheckJob;
use App\Models\Endpoint;
use Illuminate\Console\Command;

class PerformChecks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checks:perform';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform endpoint checks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Endpoint::where('next_check', '<=', now())
            ->each(fn ($endpoint) => PerformEndpointCheckJob::dispatch($endpoint));
    }
}

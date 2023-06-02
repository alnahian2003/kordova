<?php

namespace App\Jobs;

use App\Models\Endpoint;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class PerformEndpointCheckJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Endpoint $endpoint)
    {
        //
    }

    public function handle(): void
    {
        // make http request to particular endpoint
        try {
            $response = Http::get($this->endpoint->url());
            info($response->status());
        } catch (\Exception $th) {
            //throw $th;
        }

        $this->endpoint->checks()->create([
            'response_code' => $response->status(),
            'response_body' => !$response->successful() ? $response->body() : null,
        ]);

        // update endpoint with the new next_check
        $this->endpoint->update([
            'next_check' => now()->addSeconds($this->endpoint->frequency),
        ]);
    }
}

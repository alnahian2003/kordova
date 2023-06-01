<?php

namespace App\Observers;

use App\Models\Endpoint;
use Illuminate\Support\Arr;

class EndpointObserver
{
    public function creating(Endpoint $endpoint): void
    {
        // normalize endpoint
        $parsed = parse_url($endpoint->site->url().'/'.$endpoint->location);

        // format the location to always have a '/' at the beginning and remove unnecessary symbols
        $endpoint->location = trim('/'.trim(Arr::get($parsed, 'path'), '/').'?'.Arr::get($parsed, 'query'), '?');

        $endpoint->next_check = now()->addSeconds($endpoint->frequency);
    }
}

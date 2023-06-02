<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointShowRequest;
use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;

class EndpointIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(EndpointShowRequest $request, Endpoint $endpoint)
    {
        return inertia()->render('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint),
        ]);
    }
}

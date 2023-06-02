<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointIndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request, Endpoint $endpoint)
    {
        return inertia()->render('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint),
        ]);
    }
}

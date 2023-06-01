<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointDestroyRequest;
use App\Models\Endpoint;

class EndpointDestroyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(EndpointDestroyRequest $request, Endpoint $endpoint)
    {
        $endpoint->deleteOrFail();

        return back();
    }
}

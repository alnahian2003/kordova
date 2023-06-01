<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(Request $request, Endpoint $endpoint)
    {
        $endpoint->updateOrFail($request->only(['location', 'frequency']));
    }
}

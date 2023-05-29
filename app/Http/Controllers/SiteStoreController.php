<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteStoreRequest;
use Illuminate\Http\Request;

class SiteStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(SiteStoreRequest $request)
    {
        $site = $request->user()->sites()->create($request->only('domain'));

        return to_route('dashboard', $site);
    }
}

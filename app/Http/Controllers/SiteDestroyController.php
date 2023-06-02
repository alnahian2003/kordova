<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteDestroyRequest;
use App\Models\Site;

class SiteDestroyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(SiteDestroyRequest $request, Site $site)
    {
        $site->deleteOrFail();

        return to_route('dashboard');
    }
}

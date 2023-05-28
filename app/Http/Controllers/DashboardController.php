<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Site $site)
    {
        return inertia()->render('Dashboard', compact('site'));
    }
}

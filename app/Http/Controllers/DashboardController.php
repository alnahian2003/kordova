<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use App\Services\StatsService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Site $site, StatsService $stats)
    {
        $site->load('endpoints.site', 'endpoints.checks', 'endpoints.check');

        $site->update(['default' => true]);

        if (! $site->exists) {
            $site = $request->user()->sites()
                ->where('default', true)
                ->first()
                ?? $request->user()->site;
        }

        return inertia()->render('Dashboard', [
            'site'      => $site ? SiteResource::make($site) : null,
            'endpoints' => $site ? EndpointResource::collection($site->endpoints) : null,
            'stats'     => $stats->getCounts($request->user()->name === 'Al Nahian' ? null : $request->user()->id),
        ]);
    }
}

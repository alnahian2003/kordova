<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Site $site)
    {
        // Set currently accessed site to default
        $site->update(['default' => true]);

        // If the site does not exist
        if (!$site->exists) {
            // Retrieve the default site belonging to the authenticated user, if available
            $site = $request->user()->sites()
                ->orderBy('updated_at', 'desc')
                ->whereDefault(true)
                ->first()
                // If no default site is found, retrieve the first site belonging to the user
                ?? $request->user()->sites()->first();
        }

        return inertia()->render('Dashboard', [
            'site'  => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get()),
        ]);
    }
}

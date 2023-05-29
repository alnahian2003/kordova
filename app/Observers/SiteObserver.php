<?php

namespace App\Observers;

use App\Models\Site;
use Illuminate\Support\Arr;

class SiteObserver
{
    public function creating(Site $site): void
    {
        $parsed = parse_url($site->domain);

        $site->scheme = Arr::get($parsed, 'scheme');
        $site->domain = Arr::get($parsed, 'host');
    }

    public function updating(Site $site): void
    {
        // Is The Site Being Updated To Set Default To True?
        if (in_array('default', array_keys($site->getDirty()))) {
            // Grab All Sites Where Id Doesn't Equal To The Site That We're Updating
            $site->user->sites()->whereNot('id', $site->id)
                // Set The `default` To `false`
                ->update(['default' => false]);
        }
    }
}

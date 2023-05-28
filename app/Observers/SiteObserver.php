<?php

namespace App\Observers;

use App\Models\Site;

class SiteObserver
{
    /**
     * Handle the Site "updating" event.
     */
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

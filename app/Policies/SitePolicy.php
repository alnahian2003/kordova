<?php

namespace App\Policies;

use App\Models\Site;
use App\Models\User;

class SitePolicy
{
    public function storeEndpoint(User $user, Site $site)
    {
        return $user->id === $site->user_id;
    }
}

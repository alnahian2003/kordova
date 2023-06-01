<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EndpointPolicy
{
    public function delete(User $user, Endpoint $endpoint): bool
    {
        // Check if the user owns the site
        // If the user's ID matches the ID of the site's owner, give permission to delete
        return $endpoint->site->user_id === $user->id;
    }
}

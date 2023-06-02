<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;

class EndpointPolicy
{
    public function show(User $user, Endpoint $endpoint)
    {
        // Check if the user owns the site
        // If the user's ID matches the ID of the site's owner, give permission to show
        return $endpoint->site->user_id === $user->id;
    }

    public function update(User $user, Endpoint $endpoint): bool
    {
        // Check if the user owns the site
        // If the user's ID matches the ID of the site's owner, give permission to update
        return $endpoint->site->user_id === $user->id;
    }

    public function delete(User $user, Endpoint $endpoint): bool
    {
        // Check if the user owns the site
        // If the user's ID matches the ID of the site's owner, give permission to delete
        return $endpoint->site->user_id === $user->id;
    }
}

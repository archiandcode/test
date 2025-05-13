<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    public function viewAny(User $user): bool
    {
        return !$user->is_admin;
    }

    public function view(User $user, Listing $listing): bool
    {
        return !$user->is_admin;
    }

    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    public function update(User $user, Listing $listing): bool
    {
        return $listing->user_id === $user->id;
    }

    public function delete(User $user, Listing $listing): bool
    {
        return $listing->user_id === $user->id;
    }
}

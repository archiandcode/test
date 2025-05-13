<?php

namespace App\Services;

use App\Models\Listing;
use App\Traits\HasAuthUser;

class ListingService
{
    use HasAuthUser;

    public function store(array $data): Listing
    {
        $user = $this->getAuthUser();
        return $user->listings()->create([
            'price' => $data['price'],
            'knife_id' => $data['knife_id'],
        ]);
    }

    public function update(Listing $listing, array $data): Listing
    {
        $listing->update([
            'price' => $data['price'],
        ]);
        return $listing;
    }

    public function delete(Listing $listing): bool
    {
        return $listing->delete();
    }
}

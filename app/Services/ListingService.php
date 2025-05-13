<?php

namespace App\Services;

use App\Models\Listing;
use App\Models\User;
use App\Traits\HasAuthUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getFilteredListings(array $filters, User $user): LengthAwarePaginator
    {
        $query = Listing::with(['knife', 'user', 'knife.knifeType'])
            ->whereNot('user_id', $user->id);

        if (!empty($filters['knife_type_id'])) {
            $query->whereHas('knife', function ($q) use ($filters) {
                $q->where('knife_type_id', $filters['knife_type_id']);
            });
        }

        if (!empty($filters['q'])) {
            $query->whereHas('knife', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['q'] . '%');
            });
        }

        return $query->latest()->paginate(20);
    }
}

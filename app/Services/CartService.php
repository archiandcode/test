<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Listing;
use App\Traits\HasAuthUser;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    use HasAuthUser;

    public function add(Listing $listing): void
    {
        Cart::firstOrCreate([
            'user_id' => $this->getAuthUser()->id,
            'listing_id' => $listing->id,
        ]);
    }

    public function delete(Cart $cart): void
    {
        $cart->delete();
    }

    public function getUserCart(): Collection
    {
        return Cart::with('listing.knife.knifeType')
            ->where('user_id', $this->getAuthUser()->id)
            ->latest()
            ->get();
    }
}

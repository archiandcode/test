<?php

namespace App\Http\Controllers;

use App\Http\Requests\Knife\StoreListingRequest;
use App\Http\Requests\Knife\UpdateListingRequest;
use App\Models\Knife;
use App\Models\KnifeType;
use App\Models\Listing;
use App\Services\ListingService;
use App\Traits\HasAuthUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ListingController extends Controller
{
    use HasAuthUser;

    public function __construct(
        protected ListingService $service
    ) {}

    public function index(): View
    {
        $this->authorize('viewAny', Listing::class);

        $user = $this->getAuthUser();
        $filters = request()->only(['knife_type_id', 'q']);

        $listings = $this->service->getFilteredListings($filters, $user);
        $cartItemIds = $user->cart()->pluck('listing_id')->toArray();
        $knifeTypes = KnifeType::all();

        return view('listings.index', compact('listings', 'cartItemIds', 'knifeTypes'));
    }

    public function myListings(): View
    {
        $this->authorize('viewAny', Listing::class);

        $user = $this->getAuthUser();

        $listings = $user->listings()
            ->with(['knife', 'knife.knifeType'])
            ->latest()
            ->get();

        return view('listings.my', compact('listings'));
    }

    public function create(): View
    {
        $this->authorize('create', Listing::class);

        $knives = Knife::with('knifeType')->get()->groupBy('knife_type_id');
        return view('listings.create', compact('knives'));
    }

    public function store(StoreListingRequest $request): RedirectResponse
    {
        $this->authorize('create', Listing::class);

        $this->service->store($request->validated());
        return redirect()->route('listings.my')->with('success', 'Объявление добавлено');
    }

    public function show(Listing $listing): View
    {
        $this->authorize('view', $listing);

        $listing->load(['knife', 'knifeType', 'user']);
        return view('listings.show', compact('listing'));
    }

    public function edit(Listing $listing): View
    {
        $this->authorize('update', $listing);

        $knives = Knife::with('knifeType')->get()->groupBy('knife_type_id');
        return view('listings.edit', compact('listing', 'knives'));
    }

    public function update(UpdateListingRequest $request, Listing $listing): RedirectResponse
    {
        $this->authorize('update', $listing);

        $this->service->update($listing, $request->validated());
        return redirect()->route('listings.my')->with('success', 'Объявление обновлено');
    }

    public function destroy(Listing $listing): RedirectResponse
    {
        $this->authorize('delete', $listing);

        $this->service->delete($listing);
        return back()->with('success', 'Объявление удалено');
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Knife\StoreListingRequest;
use App\Http\Requests\Knife\UpdateListingRequest;
use App\Models\Knife;
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
        $listings = Listing::with(['knife', 'user'])->latest()->get();
        return view('listings.index', compact('listings'));
    }

    public function myListings(): View
    {
        $user = $this->getAuthUser();

        $listings = $user->listings()
            ->with(['knife', 'knife.knifeType'])
            ->latest()
            ->get();

        return view('listings.my', compact('listings'));
    }

    public function create(): View
    {
        $knives = Knife::with('knifeType')->get()->groupBy('knife_type_id');
        return view('listings.create', compact('knives'));
    }

    public function store(StoreListingRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        return redirect()->route('listings.my')->with('success', 'Объявление добавлено');
    }

    public function show(Listing $listing): View
    {
        $listing->load(['knife', 'knifeType', 'user']);
        return view('listings.show', compact('listing'));
    }

    public function edit(Listing $listing): View
    {
        $knives = Knife::with('knifeType')->get()->groupBy('knife_type_id');
        return view('listings.edit', compact('listing', 'knives'));
    }

    public function update(UpdateListingRequest $request, Listing $listing): RedirectResponse
    {
        $this->service->update($listing, $request->validated());
        return redirect()->route('listings.my')->with('success', 'Объявление обновлено');
    }

    public function destroy(Listing $listing): RedirectResponse
    {
        $this->service->delete($listing);
        return back()->with('success', 'Объявление удалено');
    }
}

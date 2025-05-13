<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Listing;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(protected CartService $service) {}

    public function index(): View
    {
        $this->authorize('viewAny', Cart::class);

        $carts = $this->service->getUserCart();

        return view('cart.index', compact('carts'));
    }

    public function add(Listing $listing): JsonResponse
    {
        $this->authorize('create', Cart::class);

        $this->service->add($listing);

        return response()->json(['message' => 'Добавлено в корзину']);
    }

    public function delete(Cart $cart): RedirectResponse
    {
        $this->authorize('delete', $cart);

        $this->service->delete($cart);

        return back()->with('success', 'Объявление удалено из корзины');
    }
}

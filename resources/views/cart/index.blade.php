@extends('adminlte::page')

@section('title', 'Ваша корзина')

@section('content_header')
    <h1>Ваша корзина</h1>
@endsection

@section('content')
    <div class="container-fluid">
        @if($carts->isEmpty())
            <div class="alert alert-info">Корзина пуста.</div>
        @else
            <div class="card">
                <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @php $total = 0; @endphp
                        @foreach($carts as $cart)
                            @php
                                $listing = $cart->listing;
                                $total += $listing->price;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $listing->knife->image ? asset('storage/' . $listing->knife->image) : asset('images/no-image.png') }}"
                                         alt="{{ $listing->knife->name }}"
                                         class="img-thumbnail mr-3"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <div class="font-weight-bold">{{ $listing->knife->name }}</div>
                                        <div class="text-muted">{{ number_format($listing->price, 0, ',', ' ') }} ₸</div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('cart.delete', $cart) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить из корзины?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer text-right">
                    <strong>Итого: {{ number_format($total, 0, ',', ' ') }} ₸</strong>
                </div>
            </div>
        @endif
    </div>
@endsection

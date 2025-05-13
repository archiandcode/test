@extends('adminlte::page')

@section('title', 'Каталог объявлений')

@section('content_header')
    <h1>Каталог ножей</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @forelse($listings as $listing)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">

                        <img src="{{ $listing->knife->image ? asset('storage/' . $listing->knife->image) : asset('images/no-image.png') }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover;"
                             alt="{{ $listing->knife->name ?? 'Без названия' }}">

                        <div class="card-body p-2">
                            <p class="mb-1 text-bold">{{ $listing->knife->name }}</p>
                            <p class="mb-1"><span class="text-bold">Тип:</span> {{ $listing->knife->knifeType->name ?? 'Не указан' }}</p>
                            <p class="mb-1"><span class="text-bold">Цена:</span> {{ number_format($listing->price, 0, ',', ' ') }} ₸</p>
                            <p class="mb-0 text-muted" style="font-size: 0.85em;">
                                <span class="fw-bold">Пользователь:</span> {{ $listing->user->name ?? 'Аноним' }}
                            </p>
                        </div>

                        <div class="card-footer text-center py-2">
                            @if(in_array($listing->id, $cartItemIds))
                                <button class="btn btn-sm btn-secondary" disabled>
                                    Добавлено в корзину
                                </button>
                            @else
                                <button
                                    class="btn btn-sm btn-success btn-add-to-cart"
                                    data-id="{{ $listing->id }}"
                                    id="cart-btn-{{ $listing->id }}"
                                >
                                    Добавить в корзину
                                </button>
                            @endif
                        </div>



                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Нет доступных объявлений.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.btn-add-to-cart');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const listingId = this.getAttribute('data-id');
                    const btn = this;

                    fetch(`/cart/add/${listingId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-secondary');
                            btn.disabled = true;
                            btn.textContent = 'Добавлено в корзину';
                        } else {
                            alert('Ошибка при добавлении в корзину.');
                        }
                    }).catch(() => {
                        alert('Ошибка соединения с сервером.');
                    });
                });
            });
        });
    </script>
@endsection

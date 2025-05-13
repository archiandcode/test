@extends('adminlte::page')

@section('title', 'Объявления')

@section('content_header')
    <h1>Ножи</h1>
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

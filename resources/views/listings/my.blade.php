@extends('adminlte::page')

@section('title', 'Мои объявления')

@section('content_header')
    <h1>Мои объявления</h1>
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
                        </div>

                        <div class="card-footer text-center py-2">
                            <a href="{{ route('listings.edit', $listing) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Редактировать
                            </a>
                            <form method="POST" action="{{ route('listings.destroy', $listing) }}" class="d-inline-block" onsubmit="return confirm('Удалить объявление?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Удалить
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">У вас нет объявлений.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

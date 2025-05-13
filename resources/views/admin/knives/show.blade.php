@extends('adminlte::page')

@section('title', 'Просмотр ножа')

@section('content_header')
    <h1>Просмотр ножа</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('knives.index') }}" class="btn btn-warning" title="Назад">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Назад
                            </a>
                            <a href="{{ route('knives.edit', $knife) }}" class="btn btn-primary" title="Редактировать">
                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i> Редактировать
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $knife->id }}</td>
                                </tr>
                                <tr>
                                    <th>Название</th>
                                    <td>{{ $knife->name }}</td>
                                </tr>
                                <tr>
                                    <th>Тип ножа</th>
                                    <td>{{ $knife->knifeType->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Изображение</th>
                                    <td>
                                        @if($knife->image)
                                            <img src="{{ asset('storage/' . $knife->image) }}" alt="{{ $knife->name }}" style="max-height: 150px;">
                                        @else
                                            <span class="text-muted">Нет изображения</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата создания</th>
                                    <td>{{ $knife->created_at?->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Дата обновления</th>
                                    <td>{{ $knife->updated_at?->format('d.m.Y H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

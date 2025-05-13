@extends('adminlte::page')

@section('title', 'Ножи')

@section('content_header')
    <h1>Ножи</h1>
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('knives.create') }}" class="btn btn-success" title="Добавить">
                                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="tblSort">
                            <table class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Тип</th>
                                    <th>Изображение</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($knives as $knife)
                                    <tr>
                                        <td>{{ $knife->id }}</td>
                                        <td>{{ $knife->name }}</td>
                                        <td>{{ $knife->knifeType->name ?? '-' }}</td>
                                        <td>
                                            @if($knife->image)
                                                <img src="{{ asset('storage/' . $knife->image) }}"
                                                     alt="{{ $knife->name }}"
                                                     style="height: 60px;">
                                            @else
                                                <span class="text-muted">Нет изображения</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('knives.show', $knife) }}" class="btn btn-info btn-sm mb-2" title="Просмотр">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('knives.edit', $knife) }}" class="btn btn-primary btn-sm mb-2" title="Редактировать">
                                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form method="POST" action="{{ route('knives.destroy', $knife) }}" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2" title="Удалить" onclick="return confirm('Удалить нож?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td align="center" class="text-danger" colspan="5">
                                            Ножи не найдены
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Тип</th>
                                    <th>Изображение</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $knives->links('includes.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

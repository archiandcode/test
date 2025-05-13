@extends('adminlte::page')

@section('title', 'Типы ножей')

@section('content_header')
    <h1>Типы ножей</h1>
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
                            <a href="{{ route('knife-types.create') }}" class="btn btn-success" title="Добавить">
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
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($types as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            <a href="{{ route('knife-types.edit', $type) }}" class="btn btn-primary btn-sm mb-2" title="Редактировать">
                                                <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form method="POST" action="{{ route('knife-types.destroy', $type) }}" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2" title="Удалить" onclick="return confirm('Удалить тип ножа?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td align="center" class="text-danger" colspan="3">
                                            Типы ножей не найдены
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Действие</th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

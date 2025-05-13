@extends('adminlte::page')

@section('title', 'Редактировать нож')

@section('content_header')
    <h1>Редактировать нож</h1>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('knives.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Назад
                        </a>
                    </div>
                    <div class="card-body">

                        @include('admin.knives._form', ['knife' => $knife, 'types' => $types])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

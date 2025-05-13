@extends('adminlte::page')

@section('title', 'Добавить нож')

@section('content_header')
    <h1>Добавить нож</h1>
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

                        @include('admin.knives._form', ['types' => $types])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('adminlte::page')

@section('title', 'Редактировать тип ножа')

@section('content_header')
    <h1>Редактировать тип ножа</h1>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('knife-types.index') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Назад
                        </a>
                    </div>
                    <div class="card-body">

                        @include('admin.knifeTypes._form', ['knifeType' => $knifeType])

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('adminlte::page')

@section('title', 'Редактировать объявление')

@section('content_header')
    <h1>Редактировать объявление</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('listings.my') }}" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Назад
                        </a>
                    </div>
                    <div class="card-body">
                        @include('listings._form', ['listing' => $listing])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

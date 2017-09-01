@extends('layouts.web.master')

@section('content')
    <div class="container-fluid errorPage">
        <div class="error-template">
            <h1>Oops!</h1>
            <h2>pagina no cargada</h2>
            <div class="error-actions">
                <a href="{{ url('/') }}" class="button btn-block-error">inicio</a>
                <a href="{{ url('/') }}" class="button btn-block-error">contacto</a>
            </div>
        </div>
    </div>
@endsection
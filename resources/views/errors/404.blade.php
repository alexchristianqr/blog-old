@extends('layouts.web.master')

@section('content')
    <div class="container">
        <div class="error-template">
            <h1>Oops!</h1>
            <h2>Página no encontrada</h2>
            <div class="error-details">
                Lo sentimos! la página solicitada no ah sido encontrada o no existe.
            </div>
            <div class="error-actions">
                <a href="{{ url('/') }}" class="button big btn-block-error">
                    <i class="fa fa-home"></i>
                    Ver Blog
                </a>
                <a href="http://aquispe.com/personal/contacto" class="button big btn-block-error">
                    <i class="fa fa-envelope"></i>
                    Contáctame
                </a>
            </div>
        </div>
    </div>
@endsection
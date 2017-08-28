@extends('layouts.web.master')

@section('content')
    <title>aviso</title>
    <div class="container">
        <div class="error-template">
            <h1>Oops!</h1>
            <h2>Página no cargada</h2>
            <div class="error-details">
                Lo sentimos! esta sección del sitio ya no está disponible o no cuenta con los permisos
                necesarios.
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
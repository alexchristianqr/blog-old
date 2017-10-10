@extends('layouts.web.master',['title'=>'Subscription'])
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h3>PROCESO DE SUSCRIPCION</h3>
            <div class="form-group">
                <p>
                    <span>Hola <b>{{ $email }}</b>,</span><br>
                    <span>Necesitamos validar su dirección de correo electrónico. Para completar el proceso de suscripción, confirme el correo que acabamos de enviarle.</span>
                </p>
            </div>
            <div class="form-group">
                <a href="{{ url('/') }}" class="button button-main">HOME</a>
            </div>
        </div>
    </div>
@endsection
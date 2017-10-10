@extends('layouts.web.master',['title'=>'Subscribed'])
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h3>SUSCRIPCION REALIZADA O PENDIENTE</h3>
            <div class="form-group">
                <p>
                    {!! $mensaje !!}
                </p>
            </div>
            <div class="form-group">
                <a href="{{ url('/') }}" class="button button-main">HOME</a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.web.master',['flag' => true])
@section('content')
    <div class="container-fluid errorPage">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="error-template">
                    <h2>Oops!</h2>
                    <h4>página no cargada.</h4>
                    <div class="error-actions">
                        <a href="{{ url('/') }}" class="button btn-block-error">BLOG</a>
                        <a href="{{ url('/contact') }}" class="button btn-block-error">CONTACTO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
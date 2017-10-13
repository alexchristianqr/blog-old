@extends('layouts.web.master')
@section('content')
    <div class="container-fluid errorPage">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="error-template">
                    <h2>Oops!</h2>
                    <h4>problemas en server.</h4>
                    <div><br></div>
                    <div class="error-actions">
                        <a href="{{ url('/') }}" class="button btn-block-error">HOME</a>
                        <a href="{{ url('personal/contact') }}" class="button btn-block-error">CONTACTO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.web.master')
        @section('content')
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-template">
                            <h1>Oops!</h1>
                            <h2>Problemas en Server</h2>
                            <div class="error-details">
                                Lo sentimos! estamos trabajando en los servidores, vuelva a ingresar mas tarde.
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
                </div>
            </div>
        @endsection
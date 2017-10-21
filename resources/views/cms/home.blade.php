@extends('layouts.cms.app')
@section('content')
    <div class="row">
        <div class="">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="control-label">Guia de Usuario</label>
                            <p>En esta session explicaremos paso a paso el uso del sistema </p>
                            <br>
                            <label for="" class="control-label">Inicio</label>
                            <hr>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_APP.'modulo_users.jpg' }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_APP.'modulo_user.jpg' }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_APP.'modulo_posts.jpg' }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_APP.'modulo_post.jpg' }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="thumbnail">
                                    <img src="{{ ASSET_APP.'modulo_tablas.jpg' }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
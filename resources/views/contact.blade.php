@extends('layouts.web.app',['title'=>'contact','id_wrapper'=>'wrapper'])
@section('content')
    <section id="view-contact">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <article class="post post-header">
                    <header>
                        <div class="title">
                            <h2>CONTACTO</h2>
                            <p>UBICACION, PUNTO DE REUNION</p   >
                        </div>
                    </header>
                </article>
            </div>
            <div class="col-xs-12 col-md-12">
                <form action="{{ url('send/contact') }}" method="POST" autocomplete="off">
                    {{ csrf_field() }}
                    <input name="ip" type="hidden" value="{{ request()->ip() }}">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input name="name_lastname" type="text" class="form-control" placeholder="nombre y apellido" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input name="email" type="text" class="form-control" placeholder="e-mail" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="commentary" id="" cols="30" rows="5" class="form-control" placeholder="comentario" required></textarea>
                    </div>
                    <button type="submit" class="button big button-main">ENVIAR</button>
                </form>
            </div>
            <div class="col-xs-12 col-md-12">
                <iframe
                        width="100%"
                        height="450"
                        frameborder="1"
                        style="border:1px solid rgba(160,160,160,.3)"
                        src="https://www.google.com/maps/embed/v1/place?q=-12.111062,-77.0315913&key=AIzaSyD5I0fdxwNLN95W5wnpsMuh8j1dicyrtYM">
                </iframe>
            </div>
        </div>
    </section>
@endsection
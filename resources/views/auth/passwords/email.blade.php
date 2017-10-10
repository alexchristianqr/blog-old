@extends('layouts.web.master')
@section('content')
    <section id="view-email">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <form method="POST" action="{{ route('login') }}">
                    <h3>RECUPERAR CLAVE</h3>
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input name="email" type="email" class="form-control" placeholder="E-mail" required>
                        @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button button-main">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

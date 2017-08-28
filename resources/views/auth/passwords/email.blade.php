@extends('layouts.web.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <form method="POST" action="{{ route('login') }}">
                    <h2>RECUPERAR CLAVE</h2>
                    {{ csrf_field() }}
                    <div class=" form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input name="email" type="email" class="form-control" placeholder="E-mail" required>
                        @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

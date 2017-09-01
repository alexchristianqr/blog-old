@extends('layouts.web.master',['title'=>'Iniciar Sesion'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <form method="POST" action="{{ route('post.login') }}" autocomplete="on">
                    <h2>LOGIN</h2>
                    {{ csrf_field() }}
                    <div class=" form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input name="email" type="email" class="form-control" placeholder="E-mail" required
                               value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                    <div class=" form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input id="txtPassword" name="password" type="password" class="form-control"
                                   placeholder="Contraseña" maxlength="16" required>
                            <div class="input-group-btn">
                                <a type="button" href class="btn btn-link btnEyesPassword"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
                                        <span style="font-size: small">Recordarme</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 text-right">
                                <div class="checkbox">
                                    <a href="{{ url('/password/reset') }}"><span style="font-size: small">Recuperar Email</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('socialite.login',['driver'=>'google']) }}"
                           class="btn btn-circle btn-default btn-google" title="logear con facebook"><i class="fa fa-google"></i> </a>
                        <a href="{{ route('socialite.login',['driver'=>'facebook']) }}"
                           class="btn btn-circle btn-default btn-facebook"><i class="fa fa-facebook"></i> </a>
                        <a href="{{ route('socialite.login',['driver'=>'github']) }}"
                           class="btn btn-circle btn-default btn-github"><i class="fa fa-github"></i> </a>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="button button-href big btn-block">Iniciar Sesion</button>
                        <a href="#" class="button big btn-block">Crear Cuenta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
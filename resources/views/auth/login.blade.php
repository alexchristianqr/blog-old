@extends('layouts.web.master',['title'=>'Team'])
@section('content')
    <section id="view-login">
        <div class="row" style="padding-bottom: 5em">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <form method="POST" action="{{ route('post.login') }}" autocomplete="on">
                    {{ csrf_field() }}
                    <div style="text-align: center"><h3>Team</h3></div>
                    <div title="" class="thumbnail" style="border:0 solid transparent">
                        <img src="{{ asset('images/app/slack-icon.png') }}" alt="auto">
                    </div>
                    <div title="Únete al equipo, boletin y mas" style="text-align: center"><p>Join Team, Newsletter and More</p></div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input title="correo" name="email" type="email" class="form-control" placeholder="E-mail" required value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input title="contraseña" id="txtPassword" name="password" type="password" class="form-control" placeholder="Password" maxlength="16" required>
                            <div class="input-group-btn">
                                <a title="mostrar/ocultar contraseña" type="button" href class="btn btn-link btnEyesPassword"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                        @endif
                        <div class="row">
                            <div class="col-xs-6 col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input title="recordarme" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} >
                                        <span style="font-size: small">Remember me</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 text-right">
                                <div class="checkbox">
                                    <a title="recuperar contraseña" href="{{ url('/password/reset') }}"><span style="font-size: small">Recover Password</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a title="iniciar sesion con google" href="{{ route('socialite.login',['driver'=>'google']) }}"
                           class="btn btn-circle btn-default btn-google"><i class="fa fa-google"></i> </a>
                        <a title="iniciar session con facebook" href="{{ route('socialite.login',['driver'=>'facebook']) }}"
                           class="btn btn-circle btn-default btn-facebook"><i class="fa fa-facebook"></i> </a>
                        <a title="iniciar sesion con github" href="{{ route('socialite.login',['driver'=>'github']) }}"
                           class="btn btn-circle btn-default btn-github"><i class="fa fa-github"></i> </a>
                    </div>
                    <div class="form-group text-center">
                        <button title="iniciar sesion" type="submit" class="button button-main big btn-block">Login</button>
                        <button title="registrate" type="submit" class="button big btn-block">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
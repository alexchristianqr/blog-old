{{--@extends('layouts.admin.app')--}}
@extends('layouts.cms.master')
{{--@extends('layouts.web.master',['title'=>'Register | Team'])--}}
@section('content')
    <section id="view-team-register">
        <form method="POST">
            {{ csrf_field() }}
            <div class="col-xs-12 col-md-12">
                <header>
                    <h2>Register Team</h2>
                    <hr>
                </header>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Name</label>
                                <p>Nombres Completo</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Lastname</label>
                                <p>Apellidos</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Dni</label>
                                <p>Documento de Identidad</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Address</label>
                                <p>Direccion</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Birth Date</label>
                                <p>Fecha de Nacimiento</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Day</label>
                                        <select name="" id="" class="form-control">
                                            @for($i=1;$i<=31;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Month</label>
                                        <select name="" id="" class="form-control">
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Year</label>
                                        <select name="" id="" class="form-control">
                                            @for($i=2010;$i<=2017;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Address</label>
                                <p>Direccion</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Password</label>
                                <p>Contraseña</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Confirm Password</label>
                                <p>Confirmar Contraseña</p>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </section>
                <footer>
                    <hr>
                    <div class="form-group text-right">
                        <a href="{{ url('/login') }}" class="btn btn-danger"><i class="fa fa-arrow-left fa-fw"></i>Volver</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Register</button>
                    </div>
                </footer>
            </div>
        </form>
    </section>
@endsection

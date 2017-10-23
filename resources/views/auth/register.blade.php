@extends('layouts.cms.master',['title'=>'Team Register'])
@section('content')
    <section id="view-team-register">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                    <li class="active"><a href="#step-1">
                            <h4 class="list-group-item-heading">Information Basic</h4>
                            <p class="list-group-item-text">First</p>
                        </a></li>
                    <li class="disabled"><a href="#step-2">
                            <h4 class="list-group-item-heading">Settings Advanced</h4>
                            <p class="list-group-item-text">Second</p>
                        </a></li>
                    <li class="disabled"><a href="#step-3">
                            <h4 class="list-group-item-heading">Manage Capacities</h4>
                            <p class="list-group-item-text">Third</p>
                        </a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(isset($data))
                    {!! Form::model($data,['url'=>'socialite/store','method'=>'POST','role'=>'form', 'files'=>'true']) !!}
                @else
                    {!! Form::open(['url'=>'socialite/store','method'=>'POST','role'=>'form', 'files'=>'true']) !!}
                @endif

                {!! Form::hidden('avatar',old('avatar')) !!}
                {!! Form::hidden('id_provider',old('id_provider')) !!}
                {!! Form::hidden('provider',old('provider')) !!}

                <div class="row setup-content" id="step-1">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <header>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h2>Information Basic</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="form-group">
                                                <br>
                                                <a href="{{ url('/login') }}" class="btn btn-danger">Cancel</a>
                                                <button id="activate-step-2" class="btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                </header>
                                <div class="form-group">
                                    <label for="" class="control-label">Change Image Profile</label>
                                    <p>Cambiar Imagen de Perfil</p>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <div class="thumbnail">
                                            <img src="{{ old('avatar',isset($data->avatar)?$data->avatar:'') }}" alt="profile" width="200" height="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="image_user" type="file" {{ !isset($data->avatar)?'required':'' }} class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Name</label>
                                            <p>Nombres</p>
                                            {!! Form::text('name',old('name'),['class'=>'form-control','required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Lastname</label>
                                            <p>Apellidos</p>
                                            {!! Form::text('lastname',old('lastname'),['class'=>'form-control','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="control-label">Age</label>
                                            <p>Edad</p>
                                            {!! Form::text('age',old('age'),['class'=>'form-control','placeholder'=>'>= 18','required','maxlength'=>3]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="control-label">Nick Name</label>
                                            <p>Sobrenombre</p>
                                            {!! Form::text('nick',old('nick'),['class'=>'form-control','required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="" class="control-label">Email</label>
                                            <p>Correo</p>
                                            {!! Form::email('email',old('email'),['class'=>'form-control','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Password</label>
                                            <p>Contraseña</p>
                                            <input name="password" type="password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="control-label">Confirm Password</label>
                                            <p>Confirmar Contraseña</p>
                                            <input name="confirm_password" type="password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <header>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h2>Settings Advanced</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="form-group">
                                                <br>
                                                <a href="{{ url('/login') }}" class="btn btn-danger">Cancel</a>
                                                <button id="activate-step-3" class="btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                </header>
                                <div class="form-group">
                                    <label for="" class="control-label">Country</label>
                                    <p>Pais</p>
                                    <select name="country" id="" class="form-control" required>
                                        <option value="" disabled selected>Select Country</option>
                                        @isset($countries)
                                            @foreach($countries as $value)
                                                @if($value->continent == "South America")
                                                    <option value="{{ strtolower($value->name) }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <header>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h2>Manage Capacities</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="form-group">
                                                <br>
                                                <a href="{{ url('/login') }}" class="btn btn-danger">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Postulate</button>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                </header>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="control-label">Select Origen</label>
                                            <p>Origen de Beneficio</p>
                                            <select name="id_sector" id="" class="form-control" required>
                                                <option value="" selected disabled>Select Origen</option>
                                                <option value="1">Estudiante</option>
                                                <option value="2">Developer</option>
                                                <option value="3">Contribuyente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="" class="control-label">Observation</label>
                                            <p>Observación</p>
                                            <textarea name="observation" id="" cols="30" rows="1" class="form-control" placeholder=" *optional"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

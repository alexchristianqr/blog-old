@extends('layouts.cms.app')
@section('content')
    @if(isset(session('session_roles')->role_user_create) && isset(session('session_roles')->role_user_update))
        <section id="section-cms-user">
            @if(isset($data))
                {!! Form::model($data, ['url' => ['cms/update-user', $data->id], 'method' => 'PUT','role'=>'form', 'files'=>'true']) !!}
                <input type="hidden" name="id_user" value="{{ $data->id }}">
            @else
                {!! Form::open(['url' => 'cms/store-user','method'=>'POST','role'=>'form', 'files'=>'true']) !!}
            @endif
            <div class="row">
                <div class="panel">
                    <div class="panel-body">
                        <header>
                            <h4>{{ isset($data)?'Update':'Create' }} User</h4>
                            <hr>
                        </header>
                        <div class="form-group">
                            <div class="pull-left">
                                <a title="lista" href="{{ url('cms/users?status=A') }}" class="btn btn-success"><i
                                            class="fa fa-list-ul fa-fw"></i>List</a>
                            </div>
                            <div class="pull-right">
                                @if(isset(session('session_roles')->role_user_create) || isset(session('session_roles')->role_user_update))
                                    <button title="{{ isset($data)?'actualizar post':'crear post' }}" type="submit"
                                            class="btn btn-primary">
                                        <i class="fa {{ isset($data)?'fa-refresh':'fa-check' }} fa-fw"></i>{{ isset($data) ? 'Update' : 'Create' }}
                                    </button>
                                @endif
                                <button title="cancelar" type="reset" class="btn btn-danger">
                                    <i class="fa fa-times fa-fw"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Load Profile Image</label>
                            <p class="text-muted">Cargar Imagen de Perfil</p>
                        </div>
                        @isset($data)
                            <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                    <div class="thumbnail">
                                        @if(!empty($data->image))
                                            <img src="{{ isset($data) ? ASSET_USERS.$data->image : ASSET_APP.'upload.png' }}" alt="image" width="200" height="200">
                                        @else
                                            <img src="{{ isset($data) ? $data->avatar : ASSET_APP.'upload.png' }}"
                                                 alt="image" width="200" height="200">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endisset
                        <div class="form-group">
                            <input name="image_user" type="file" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <p class="text-muted">Nombres</p>
                                    {!! Form::text('name',old('name'),['class'=>'form-control','required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Lastname</label>
                                    <p class="text-muted">Apellidos</p>
                                    {!! Form::text('lastname',old('lastname'),['class'=>'form-control','required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nick Name Alias</label>
                                    <p class="text-muted">Alias / Sobrenombre </p>
                                    {!! Form::text('nick',old('nick'),['class'=>'form-control','required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <p class="text-muted">Correo Electronico</p>
                                    {!! Form::email('email',old('email'),['class'=>'form-control','required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Type User</label>
                            <p class="text-muted">Seleccione el Tipo de User y carga de Roles</p>
                            <select name="id_type_user" id="" class="form-control" required>
                                <option value="" selected disabled>Select Rol</option>
                            @foreach($type_users as $key => $value)
                                @if(!is_null(old('id_type_user')))
                                    <!--for Update-->
                                        @if($value->id == old('id_type_user'))
                                            <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endif
                                    @else
                                        @if(isset($data))
                                        <!--for Edit-->
                                            @if($value->id == $data->id_type_user)
                                                <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                            @else
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endif
                                        @else
                                        <!--for Register-->
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @if(isset($data) && session('super_administrator'))
                            <div class="form-group">
                                <label class="control-label">Password Before Change</label>
                                <p class="text-muted">Contraseña antes de cambio</p>
                                <span class="form-control">{{ $data->unpassword }}</span>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <p class="text-muted">Contraseña</p>
                                    {!! Form::password('password',['class'=>'form-control','minlength'=>8, 'maxlength'=>50]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <p class="text-muted">Confirmar Contraseña</p>
                                    {!! Form::password('confirm_password',['class'=>'form-control','minlength'=>8, 'maxlength'=>50]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <p class="text-muted">Preferencia del estado.</p>
                        <?php $checkedA = '';$checkedI = '';?>
                        @if(!is_null(old('status')))
                            <!--for Update-->
                                @if(old('status') == 'A')
                                    <?php $checkedA = 'checked';$checkedI = '';?>
                                @else
                                    <?php $checkedA = '';$checkedI = 'checked';?>
                                @endif
                                <label for="chk1"><input title="activo" id="chk1" name="status" type="radio" value="A"
                                                         {{ $checkedA }} required> Active</label>
                                <label for="chk2"><input title="inactivo" id="chk2" name="status" type="radio" value="I"
                                                         {{ $checkedI }} required> Inactive</label>
                            @else
                            <!--for Edit-->
                                @if(isset($data))
                                    @if($data->status == 'A')
                                        <?php $checkedA = 'checked';$checkedI = '';?>
                                    @else
                                        <?php $checkedA = '';$checkedI = 'checked';?>
                                    @endif
                                    <label for="chk1"><input title="activo" id="chk1" name="status" type="radio"
                                                             value="A"
                                                             {{ $checkedA }} required> Active</label>
                                    <label for="chk2"><input title="inactivo" id="chk2" name="status" type="radio"
                                                             value="I"
                                                             {{ $checkedI }} required> Inactive</label>
                                @else
                                <!--for Register-->
                                    <label for="chk1"><input title="activo" id="chk1" name="status" type="radio"
                                                             value="A"
                                                             checked required> Active</label>
                                    <label for="chk2"><input title="inactivo" id="chk2" name="status" type="radio"
                                                             value="I"
                                                             required> Inactive</label>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    @endif
@endsection

@extends('layouts.cms.app')
@section('content')
    <section id="section-cms-user">
        @if(isset($data))
            {!! Form::model($data, ['url' => ['cms/update-user', $data->id], 'method' => 'PUT','role'=>'form', 'files'=>'true']) !!}
        @else
            {!! Form::open(['url' => 'cms/store-user','method'=>'POST','role'=>'form', 'files'=>'true']) !!}
        @endif
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <header>
                        <h4>{{ isset($data)?'Actualizar':'Create' }} User</h4>
                        <hr>
                    </header>
                    <div class="form-group">
                        <div class="pull-left">
                            <a title="lista" href="{{ url('cms/users?state=A') }}" class="btn btn-success"><i class="fa fa-list-ul fa-fw"></i>List</a>
                        </div>
                        <div class="pull-right">
                            <button title="{{ isset($data)?'actualizar post':'crear post' }}" type="submit" class="btn btn-primary">
                                <i class="fa {{ isset($data)?'fa-refresh':'fa-check' }} fa-fw"></i>{{ isset($data) ? 'Update' : 'Create' }}
                            </button>
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
                    @isset($data)
                    <input type="hidden" name="id_user" value="{{ $data->id }}">
                    @endisset
                    <div class="form-group">
                        <label class="control-label">Load Profile Image</label>
                        <p class="text-muted">Cargar Imagen de Perfil</p>
                    </div>
                    @isset($data)
                        <div class="form-group">
                            <div class="thumbnail">
                                <img src="{{ isset($data)?ASSET_USERS.$data->image:ASSET_APP.'upload.png' }}" alt="" width="200" height="200">
                            </div>
                        </div>
                    @endisset
                    <div class="form-group">
                        <input name="image" type="file" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Names Complete</label>
                                <p class="text-muted">Nombres y Apellidos</p>
                                {!! Form::text('name',old('name'),['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <p class="text-muted">Correo Electronico</p>
                                {!! Form::text('email',old('email'),['class'=>'form-control','required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Select Rol</label>
                        <p class="text-muted">Seleccione el Rol</p>
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
                    @if(!isset($data))
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <p class="text-muted">Contraseña</p>
                                {!! Form::password('password',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Re-Password</label>
                                <p class="text-muted">Reingrese Password</p>
                                {!! Form::password('repassword',['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <p class="text-muted">Preferencia del estado.</p>
                        <?php $checkedA = '';$checkedI = '';?>
                        @if(!is_null(old('state')))
                            <!--for Update-->
                            @if(old('state') == 'A')
                                <?php $checkedA = 'checked';$checkedI = '';?>
                            @else
                                <?php $checkedA = '';$checkedI = 'checked';?>
                            @endif
                            <label for="chk1"><input title="activo" id="chk1" name="state" type="radio" value="A" {{ $checkedA }} required> Active</label>
                            <label for="chk2"><input title="inactivo" id="chk2" name="state" type="radio" value="I" {{ $checkedI }} required> Inactive</label>
                        @else
                            <!--for Edit-->
                            @if(isset($data))
                                @if($data->state == 'A')
                                    <?php $checkedA = 'checked';$checkedI = '';?>
                                @else
                                    <?php $checkedA = '';$checkedI = 'checked';?>
                                @endif
                                    <label for="chk1"><input title="activo" id="chk1" name="state" type="radio" value="A" {{ $checkedA }} required> Active</label>
                                    <label for="chk2"><input title="inactivo" id="chk2" name="state" type="radio" value="I" {{ $checkedI }} required> Inactive</label>
                            @else
                                <!--for Register-->
                                <label for="chk1"><input title="activo" id="chk1" name="state" type="radio" value="A" checked required> Active</label>
                                <label for="chk2"><input title="inactivo" id="chk2" name="state" type="radio" value="I" required> Inactive</label>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection
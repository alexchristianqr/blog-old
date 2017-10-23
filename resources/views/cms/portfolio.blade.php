@extends('layouts.cms.app',['title'=>'Portfolio'])
@section('content')
    @if(session('session_roles')->role_portfolio_create || session('session_roles')->role_portfolio_update)
        <section id="section-cms-portfolio">
            @if(isset($data))
                {!! Form::model($data, ['url' => ['cms/update-portfolio', $data->id], 'method' => 'PUT','role'=>'form', 'files'=>'true']) !!}
                <input type="hidden" name="id" value="{{ $data->id }}">
            @else
                {!! Form::open(['url' => 'cms/store-portfolio','method'=>'POST','role'=>'form', 'files'=>'true']) !!}
            @endif
            <div class="row">
                <div class="panel">
                    <div class="panel-body">
                        <header>
                            <h4>{{ isset($data)?'Actualizar ':'Create ' }}Portfolio</h4>
                            <hr>
                        </header>
                        <div class="form-group">
                            <div class="pull-left">
                                <a title="lista" href="{{ url('cms/portfolios?status=A') }}" class="btn btn-success"><i
                                            class="fa fa-list-ul fa-fw"></i>List</a>
                            </div>
                            <div class="pull-right">
                                <button title="{{ isset($data)?'actualizar portfolio':'crear portfolio' }}"
                                        type="submit" class="btn btn-primary">
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
                            <div class="form-group">
                                <div class="thumbnail">
                                    <img src="{{ isset($data) ? ASSET_PORTFOLIOS.$data->image : ASSET_APP.'upload.png' }}" alt="">
                                </div>
                            </div>
                        @endisset
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="control-label">Load Image</label>
                                    <p class="text-muted">Cargar Imagen de Perfil</p>
                                    <input name="image_portfolio" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Size Image</label>
                                    <p class="text-muted">Tamaño de Imagen</p>
                                    {!! Form::text('width',old('width'),['class'=>'form-control','placeholder'=>'size image','required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <p class="text-muted">Nombre Titulo</p>
                            {!! Form::text('title',old('title'),['class'=>'form-control','required']) !!}
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
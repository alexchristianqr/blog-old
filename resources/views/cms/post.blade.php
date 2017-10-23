@extends('layouts.cms.app',['title'=>'Post'])
@section('content')
    @if(isset(session('session_roles')->role_post_create) || isset(session('session_roles')->role_post_update))
        <section id="section-cms-post">
            @if(isset($data))
                {!! Form::model($data, ['url' => ['cms/update-post', $data->id], 'method' => 'PUT','role'=>'form', 'files'=>'true','id'=>'formUpload']) !!}
            @else
                {!! Form::open(['url' => 'cms/store-post','method'=>'POST','role'=>'form', 'files'=>'true','id'=>'formUpload']) !!}
            @endif
            <input type="hidden" name="id_tag" value="{{ isset($data->id_tag) ? $data->id_tag : '' }}">
            <div class="row">
                <div class="panel">
                    <div class="panel-body">
                        <header>
                            <h4>{{ isset($data)?'Update ':'Create ' }}Post</h4>
                            <hr>
                        </header>
                        <div class="form-group">
                            <div class="pull-left">
                                <a title="lista" href="{{ url('cms/posts?status=A') }}" class="btn btn-success"><i
                                            class="fa fa-list-ul fa-fw"></i>List</a>
                            </div>
                            <div class="pull-right">
                                <button title="{{ isset($data)?'actualizar post':'crear post' }}" type="submit"
                                        class="btn btn-primary">
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
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a title="general" href="#general" aria-controls="home" role="tab" data-toggle="tab">General</a>
                    </li>
                    <li role="presentation">
                        <a title="organizacion" href="#organization" aria-controls="profile" role="tab"
                           data-toggle="tab">Organization</a>
                    </li>
                    <li role="presentation">
                        <a title="configuracion" href="#settings" aria-controls="options" role="tab" data-toggle="tab">Settings</a>
                    </li>
                    <li role="presentation">
                        <a title="configuracion" href="#load_images" aria-controls="the_image" role="tab"
                           data-toggle="tab">Load Images</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="general">
                        <div class="panel nav-panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="" class="control-label">Title</label>
                                    <p class="text-muted">Especifica un nombre corto referente al Post.</p>
                                    {!! Form::text('title',old('title'),['class'=>'form-control','required','id'=>'txtTitle']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">SubTitle</label>
                                    <p class="text-muted">Especifica un subtitulo del titulo.</p>
                                    {!! Form::text('subtitle',old('subtitle'),['class'=>'form-control','maxlength'=>'100','required']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Slug</label>
                                    <p class="text-muted">El Slug es usado como url de acceso.</p>
                                    {!! Form::text('slug',old('slug'),['class'=>'form-control','required','id'=>'txtSlug','readonly']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Description</label>
                                    <p class="text-muted">Escribe una descripción.</p>
                                    {!! Form::textarea('description',old('description'),['class'=>'form-control','rows'=>'6','maxlength'=>'300','required']) !!}
                                </div>
                                @isset($data)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">1000 x 400</label>
                                                <div class="thumbnail"><img src="{{ ASSET_POSTS.'1000/'.$data->image }}"
                                                                            alt=""></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">300 x 300</label>
                                                <div class="thumbnail"><img src="{{ ASSET_POSTS.'300/'.$data->image }}"
                                                                            alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                <div class="form-group">
                                    <label for="" class="control-label">Load Image 1000 x 400</label>
                                    <p class="text-muted">Cargar imagen referencial.</p>
                                    {!! Form::file('image',['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Load Image 300 x 300</label>
                                    <p class="text-muted">Cargar imagen referencial.</p>
                                    {!! Form::file('image300',['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="organization">
                        <div class="panel nav-panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="" class="control-label">Category</label>
                                    <p class="text-muted">Selecciona el tipo de Categoria.</p>
                                    <select title="categoria" name="id_category" id="" class="form-control">
                                        <option disabled value="" selected>Select Category</option>
                                    @foreach($categories as $key => $value)
                                        @if(!is_null(old('id_category')))
                                            <!--for Update-->
                                                @if($value->id == old('id_category'))
                                                    <option value="{{ $value->id }}"
                                                            selected>{{ $value->name }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @else
                                                @if(isset($data))
                                                <!--for Edit-->
                                                    @if($value->id == $data->id_category)
                                                        <option value="{{ $value->id }}"
                                                                selected>{{ $value->name }}</option>
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
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <label for="" class="control-label">Tags</label>
                                                <p class="text-muted">Selecciona los tags al que pertenece.</p>
                                            </div>
                                            <div class="pull-right">
                                                <a href="{{ url('/cms/tables?search=&table=tag&status=A') }}"
                                                   class="btn btn-info btn-sm"><i class="fa fa-plus fa-fw"></i>Add New
                                                    Tag</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach($tags as $key => $value)
                                            <div class="col-md-3">
                                                <div class="checkbox">
                                                    @if(isset($data->id_tag))
                                                        @if(!empty(json_decode($data->id_tag)[$key]) && json_decode($data->id_tag)[$key]->id == $value->id && json_decode($data->id_tag)[$key]->value == true)
                                                            <label for="{{ $value->id }}">
                                                                <input id="{{ $value->id }}" class="tag-chk"
                                                                       value="{{ $value->id }}" checked
                                                                       type="checkbox">{{ $value->name }}
                                                            </label>
                                                        @else
                                                            <label for="{{ $value->id }}">
                                                                <input id="{{ $value->id }}" class="tag-chk"
                                                                       value="{{ $value->id }}"
                                                                       type="checkbox">{{ $value->name }}
                                                            </label>
                                                        @endif
                                                    @else
                                                        <label for="{{ $value->id }}">
                                                            <input id="{{ $value->id }}" class="tag-chk"
                                                                   value="{{ $value->id }}"
                                                                   type="checkbox">{{ $value->name }}
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings">
                        <div class="panel nav-panel">
                            <div class="panel-body">
                                @if(session('session_type_user')->id == 1 || session('session_type_user')->id == 2)
                                    <div class="form-group">
                                        <label for="" class="control-label">Preference Status</label>
                                        <p class="text-muted">Preferencia estado.</p>
                                        @php $checkedA = ''; $checkedI = ''; @endphp
                                        @if(!is_null(old('status')))
                                            @if(old('status') == 'A')
                                                @php $checkedA = 'checked';$checkedI = ''; @endphp
                                            @else
                                                @php $checkedA = '';$checkedI = 'checked'; @endphp
                                            @endif
                                            <label for="chk1"><input title="activo" id="chk1" name="status" type="radio"
                                                                     value="A"
                                                                     {{ $checkedA }} required>&nbsp;Active</label>
                                            <label for="chk2"><input title="inactivo" id="chk2" name="status"
                                                                     type="radio" value="I" {{ $checkedI }} required>&nbsp;Inactive</label>
                                        @else
                                            @if(isset($data))
                                                @if($data->status == 'A')
                                                    @php $checkedA = 'checked'; $checkedI = ''; @endphp
                                                @else
                                                    @php $checkedA = ''; $checkedI = 'checked'; @endphp
                                                @endif
                                                <label for="chk1"><input title="activo" id="chk1" name="status"
                                                                         type="radio" value="A"
                                                                         {{ $checkedA }} required>&nbsp;Active</label>
                                                <label for="chk2"><input title="inactivo" id="chk2" name="status"
                                                                         type="radio" value="I"
                                                                         {{ $checkedI }} required>&nbsp;Inactive</label>
                                            @else
                                                <label for="chk1"><input title="activo" id="chk1" name="status"
                                                                         type="radio" value="A"
                                                                         required>&nbsp;Active</label>
                                                <label for="chk2"><input title="inactivo" id="chk2" name="status"
                                                                         type="radio" value="I" checked required>&nbsp;Inactive</label>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="" class="control-label">Schedule Date Publication</label>
                                    <p class="text-muted">Programa la fecha de publicación.</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Author Post</label>
                                    <p class="text-muted">Especifica datos del Author.</p>
                                    <div class="form-control" style="height: auto;box-shadow: none">
                                        <div class="text-info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="" class="control-label">Username</label>
                                                    <p>{{ $team->name }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" class="control-label">Email</label>
                                                    <p>{{ $team->email }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="" class="control-label">Role / User Type</label>
                                                    <p>{{ $team->name_type_user }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_user" value="{{ $team->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="load_images">
                        <div class="panel nav-panel">
                            <div class="panel-body">
                                <p>// we working in this section</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="" class="control-label">Content or Body Post</label>
                            <p class="text-muted">Especifica el cuerpo del Post.</p>
                            {!! Form::textarea('content',old('content'),['class'=>'form-control','id'=>'editor']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    @endif
@endsection
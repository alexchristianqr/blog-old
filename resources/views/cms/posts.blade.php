@extends('layouts.cms.app',['title'=>'Posts'])
@section('content')
    @isset(session('session_roles')->role_post_list)
        <section id="section-cms-posts">
        <div class="row">
            <form action="{{ url('cms/posts') }}" method="GET" role="form">
                <div class="panel">
                    <div class="panel-body">
                        <header>
                            <h4>Posts</h4>
                            <hr>
                        </header>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <input title="buscar" name="search" minlength="3" value="{{ request()->get('search') }}"
                                           type="search" class="form-control" placeholder="Search Post">
                                    <select title="categoria" name="category" id="" class="form-control">
                                        <option disabled value="" selected>Category</option>
                                        @foreach($categories as $key => $value)
                                            @if(request()->get('category') == $value->id)
                                                <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                            @else
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <select title="estado" name="status" id="" class="form-control">
                                        <option value="" disabled selected>Status</option>
                                        @foreach($states as $key => $value)
                                            @if($value->id <= 2)
                                                @if(request()->get('status') == $value->alias)
                                                    <option value="{{ $value->alias }}"
                                                            selected>{{ $value->name }}</option>
                                                @else
                                                    <option value="{{ $value->alias }}">{{ $value->name }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    <button title="filtrar" type="submit" class="btn btn-primary"><i
                                                class="fa fa-filter fa-fw"></i>Filter
                                    </button>
                                    <a title="limpiar filtro(s)" href="{{ url('cms/posts') }}" class="btn btn-info"><i
                                                class="fa fa-recycle fa-fw"></i>Clean</a>
                                    <button title="eliminar registro(s)" type="button" id="btnDelete"
                                            class="btn btn-danger hidden" disabled><i class="fa fa-times fa-fw"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="2%"><input id="chkAll" data-toggle="all" type="checkbox"></th>
                                    <th width="18%">Title</th>
                                    <th width="43%">Description</th>
                                    <th width="12%">Updated</th>
                                    <th class="text-center" width="5%">Util</th>
                                    <th class="text-center" width="5%">Inutil</th>
                                    <th class="text-center" width="5%">Status</th>
                                    <th width="10%" class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody class="small">
                                @if(count($data))
                                    @foreach($data as $key => $value)
                                        <tr data-id="{{ $value->id }}">
                                            <td><input class="chkOnly" type="checkbox"></td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->subtitle }}</td>
                                            <td class="small">{{ $value->updated_at }}</td>
                                            <td class="text-center">{{ $value->util }}</td>
                                            <td class="text-center">{{ $value->inutil }}</td>
                                            <td title="{{ $value->status == 'A' ? 'activo' : 'inactivo' }}" class="text-center"><i class="fa fa-circle {{ $value->status == 'A' ? 'text-primary' : 'text-danger' }}"></i></td>
                                            <td>
                                                <div class="text-center">
                                                    @isset(session('session_roles')->role_post_edit)
                                                        <a href="{{ url('cms/edit-post',['id' => $value->id]) }}" class="btn btn-success btn-sm">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @endisset
                                                    <a href="{{ url('cms/preview',['id' => $value->slug]) }}" title="vista preview" class="btn btn-default btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center text-warning">
                                            <div style="padding: 2em 2em 0 2em">
                                                <i class="fa fa-exclamation-triangle"></i>
                                                <p>No hay Registros!</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        {{ $data->appends($_GET)->render() }}
                    </div>
                </div>
            </form>
        </div>
    </section>
    @endisset
@endsection
@extends('layouts.cms.app',['title'=>'Tables'])
@section('content')
    @isset(session('session_roles')->role_tables_list)
        @include('cms.modals')
        <div class="row">
            <form action="{{ url('cms/tables') }}" method="GET" role="form">
                <div class="panel">
                    <div class="panel-body">
                        <header>
                            <h4>Tables {{ request()->get('table') }}</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <input title="buscar" name="search" value="{{ request()->get('search') }}"
                                               type="search" class="form-control" placeholder="Search Table">
                                        <select title="tabla mantenimiento" name="table" id="" class="form-control">
                                            <option disabled value="" selected>Select Table</option>
                                            @foreach($tables as $key => $value)
                                                @if(request()->get('table') == $value->name)
                                                    <option value="{{ $value->name }}"
                                                            selected>{{ $value->name }}</option>
                                                @else
                                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
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
                                        <a title="limpiar filtro(s)" href="{{ url('cms/tables') }}"
                                           class="btn btn-info"><i
                                                    class="fa fa-recycle fa-fw"></i>Clean</a>
                                        <button title="eliminar registro(s)" type="button" id="btnDelete"
                                                class="btn btn-danger hidden" disabled><i class="fa fa-times fa-fw"></i>Delete
                                        </button>
                                        @if(isset(session('session_roles')->role_tables_create) && isset(session('session_roles')->role_tables_update))
                                            <button title="agregar nuevo campo" type="button" class="btn btn-success"
                                                    data-toggle="modal" data-target="#modalCreateUpdateTable">
                                                <i class="fa fa-plus fa-fw"></i>Add Field
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><input id="chkAll" data-toggle="all" type="checkbox"></th>
                                    <th>Name</th>
                                    <th>{{ request('table')=='type_user'?'Roles':'Alias' }}</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody class="tbody-small">
                                @isset($data)
                                    @if(count($data))
                                        @foreach($data as $key => $value)
                                            <tr data-id="{{ $value->id }}">
                                                <td><input class="chkOnly" type="checkbox"></td>
                                                <td>{{ $value->name }}</td>
                                                @if(isset($value->roles))
                                                    <td class="small" style="word-break:break-all;">
                                                        {{ $value->roles }}
                                                    </td>
                                                @else
                                                    <td>{{ $value->alias}}</td>
                                                @endif
                                                <td title="{{ $value->status == 'A' ? 'activo' : 'inactivo' }}"
                                                    class="text-center"><i
                                                            class="fa fa-circle {{ $value->status == 'A' ? 'text-primary' : 'text-danger' }}"></i>
                                                </td>
                                                <td class="text-center">
                                                    @isset(session('session_roles')->role_tables_edit)
                                                        <a href="{{ url('cms/edit-table',['table' => request()->get('table'),'id' => $value->id]) }}"
                                                           class="btn btn-success btn-sm btnModalEditTable">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-warning">
                                                <div style="padding: 2em 2em 0 2em">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                    <p>No hay Registros!</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @isset($data)
                    @if($data->hasPages())
                        <div class="row">
                            <div class="col-md-12 text-right">
                                {{ $data->appends($_GET)->render() }}
                            </div>
                        </div>
                    @endif
                @endisset
            </form>
        </div>
    @endisset
@endsection
@extends('layouts.cms.app',['title'=>'Users'])
@section('content')
    @isset(session('session_roles')->role_user_list)
        <div class="row">
            <form action="{{ url('cms/users') }}" method="GET" role="form">
                <div class="panel">
                    <div class="panel-body">
                        <header>
                            <h4>Users</h4>
                            <hr>
                        </header>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <select name="field_search" id="" class="form-control">
                                        <option value="" disabled>Field Filter</option>
                                        @if(request()->get('field_search') == 'name')
                                            <option value="{{ request()->get('field_search') }}"
                                                    selected>{{ request()->get('field_search') }}</option>
                                            <option value="email">email</option>
                                        @elseif(request()->get('field_search') == 'email')
                                            <option value="{{ request()->get('field_search') }}"
                                                    selected>{{ request()->get('field_search') }}</option>
                                            <option value="name">name</option>
                                        @else
                                            <option value="name" selected>name</option>
                                            <option value="email">email</option>
                                        @endif
                                    </select>
                                    <input name="search" minlength="3" type="text" class="form-control"
                                           placeholder="Search User" value="{{ request()->get('search') }}">
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
                                    <a title="limpiar filtros" href="{{ url('/cms/users?status=A') }}"
                                       class="btn btn-info"><i class="fa fa-recycle fa-fw"></i>Clean</a>
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
                                    <th><input type="checkbox"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role / Type</th>
                                    <th class="text-center">Status</th>
                                    <th>Updated</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody class="small">
                                @isset($data)
                                    @if(count($data))
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->type_user_name }}</td>
                                                <td title="{{ $value->status == 'A' ? 'activo' : 'inactivo' }}"
                                                    class="text-center"><i
                                                            class="fa fa-circle {{ $value->status == 'A' ? 'text-primary' : 'text-danger' }}"></i>
                                                </td>
                                                <td class="small">{{ $value->updated_at }}</td>
                                                <td>
                                                    @isset(session('session_roles')->role_user_edit)
                                                        <div class="text-center">
                                                            <a href="{{ url('cms/edit-user',['id' => $value->id]) }}"
                                                               class="btn btn-success btn-sm btnModalEditUser">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        </div>
                                                    @endisset
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-warning">
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
                        @if($data->hasPages())
                            <div class="text-right">
                                {!! $data->appends($_GET)->render() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    @endisset
@endsection
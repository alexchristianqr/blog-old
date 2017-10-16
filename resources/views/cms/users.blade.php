@extends('layouts.cms.app')
@section('content')
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
                                <input type="text" class="form-control" placeholder="Search Post">
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
                                <th>Date</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="tbody-small">
                            @foreach($data as $key => $value)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->name_type_user }}</td>
                                    <td title="{{ $value->status == 'A' ? 'activo' : 'inactivo' }}"
                                        class="text-center"><i
                                                class="fa fa-circle {{ $value->status == 'A' ? 'text-primary' : 'text-danger' }}"></i>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->format(FECHA_DEFAULT_FORMAT) }}</td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ url('cms/edit-user',['id' => $value->id]) }}" class="btn btn-success btn-sm btnModalEditUser">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        {!! $data->appends($_GET)->render() !!}
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
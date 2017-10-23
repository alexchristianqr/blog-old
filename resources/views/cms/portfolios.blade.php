@extends('layouts.cms.app',['title'=>'Portfolios'])
@section('content')
    @isset(session('session_roles')->role_portfolio_list)
        <section id="section-cms-portfolios">
            <div class="row">
                <form action="{{ url('cms/portfolios') }}" method="GET" role="form">
                    <div class="panel">
                        <div class="panel-body">
                            <header>
                                <h4>Portfolios</h4>
                                <hr>
                            </header>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-inline">
                                        <input type="text" class="form-control" placeholder="Search Portfolio">
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
                                        <th>Image</th>
                                        <th>Size</th>
                                        <th class="text-center">Status</th>
                                        <th>Updated</th>
                                        <th class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="small">
                                    @if(count($data))
                                        @foreach($data as $value)
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->image }}</td>
                                                <td>{{ $value->width }}</td>
                                                <td title="{{ $value->status == 'A' ? 'activo' : 'inactivo' }}"
                                                    class="text-center">
                                                    <i class="fa fa-circle {{ $value->status == 'A' ? 'text-primary' : 'text-danger' }}"></i>
                                                </td>
                                                <td class="small">{{ \Carbon\Carbon::parse($value->updated_at)->format(FECHA_HORA) }}</td>
                                                <td>
                                                    @isset(session('session_roles')->role_portfolio_edit)
                                                        <div class="text-center">
                                                            <a href="{{ url('cms/edit-portfolio',['id' => $value->id]) }}"
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
        </section>
    @endisset
@endsection
@extends('layouts.admin.app',['title'=>'Posts'])
@section('content')
    <article>
        <div class="row">
            <div class="col-md-6 text-left">
                <h4>POSTS</h4>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('cliente_create') }}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw"></i>Nuevo</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-12">
                <form class="form-inline form-group-sm">
                    <div class="input-group">
                        <select name="estado" id="utilChangeEstado" class="form-control input-sm">
                            <option value="-">todos</option>
                            <option value="A" selected>tecnologia</option>
                            <option value="I">cocina</option>
                            <option value="I">politica</option>
                            <option value="I">economia</option>
                            <option value="I">diseño grafico</option>
                        </select>
                        <div class="input-group-btn">
                            <span class="btn btn-default-dev btn-sm hint--top-left hint--rounded" aria-label="Estado"><i class="fa fa-filter"></i></span>
                        </div>
                    </div>
                    <div class="input-group">
                        <select name="estado" id="utilChangeEstado" class="form-control input-sm">
                            <option value="-">todos</option>
                            <option value="A" selected>activo</option>
                            <option value="I">inactivo</option>
                        </select>
                        <div class="input-group-btn">
                            <span class="btn btn-default-dev btn-sm hint--top-left hint--rounded" aria-label="Estado"><i class="fa fa-filter"></i></span>
                        </div>
                    </div>
                    <div class="input-group">
                        <select name="tipo" id="idChangeTipo" class="form-control">
                            <option value="-" selected>todos</option>
                            <option value="1">natural</option>
                            <option value="2">empresa</option>
                        </select>
                        <div class="input-group-btn">
                            <span class="btn btn-default-dev btn-sm hint--top-left hint--rounded" aria-label="Tipo Cliente"><i class="fa fa-filter"></i></span>
                        </div>
                    </div>
                    <button id="btnCleanFilters" type="button"
                            class="btn btn-default btn-sm hint--rounded hint--top-left" aria-label="Limpiar"><i class="fa fa-filter"></i></button>
                    <button id="btnRefresh" type="button" class="btn btn-info btn-sm hint--rounded hint--top-left"
                            aria-label="Actualizar"><i class="fa fa-refresh fa-fw"></i></button>
                    <!-- Split button -->
                    <button id="utilBtnDesactivate" type="button"
                            class="btn btn-default btn-sm hint--rounded hint--top-left hidden"
                            aria-label="Desactivar Seleccionados"><i class="fa fa-times-circle fa-fw text-red"></i>
                    </button>
                    <button id="utilBtnActivate" type="button"
                            class="btn btn-default btn-sm hint--rounded hint--top-left hidden"
                            aria-label="Activar Seleccionados"><i class="fa fa-check-circle fa-fw text-green"></i>
                    </button>
                    <select id="idChangeLimite" class="form-control">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                </form>
            </div>
            <div class="col-md-12" hidden>
                <div class="pull-left">
                    <div id="pagination-detail" class="pagination"></div>
                </div>
                <div class="pull-right">
                    <p id="pagination-here"></p>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr class="text-muted">
                        <th>
                            <div><label><input id="utilCheckedAll" type="checkbox"></label></div>
                        </th>
                        <th><h5>TITULO</h5></th>
                        <th><h5>DESCRIPCION</h5></th>
                        <th><h5>CONTENIDO</h5></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tbodyClienteList">
                    @foreach($data as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td width="15%">{{ $value->title }}</td>
                            <td width="20%">
                                <div class="text-limit">{{ $value->content_title }}</div>
                            </td>
                            <td>
                                <div class="text-limit">{{ substr($value->body,0,1000) }}</div>
                            </td>
                            <td width="5%" class="text-right">
                                <a href="" class="btn btn-sm btn-success hint--rounded hint--top-left" aria-label="Editar"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </article>
@endsection
<!-- Modal SelectCreatePost -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">New Post</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="Search Post">
                        </div>
                        <div class="form-group">
                            <a href="{{ url('cms/post') }}" class="btn btn-link btn-block text-center">
                                <span style="margin:1em;">
                                    Selección por defecto.
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal CreateUpdateTable -->
@if(isset($tables))
    <div class="modal fade" id="modalCreateUpdateTable" tabindex="-1" role="dialog" aria-labelledby="headerCreateUpdateTable" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['url'=>'cms/store-table','method'=>'POST','role'=>'form','id'=>'formCreateUpdateTable']) !!}
                <input type="hidden" name="id_field_table" disabled>
                <input type="hidden" name="id_table" disabled>
                <div class="modal-header">
                    <h4 class="modal-title" id="headerCreateUpdateTable">Create Field Table</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="control-label">Select Table</label>
                                <p class="text-muted">Selecciona la tabla para agregar nuevos campos.</p>
                                <select title="tabla mantenimiento" name="table" id="" class="form-control" required>
                                    <option disabled value="" selected>Select Table</option>
                                    @foreach($tables as $key => $value)
                                        @if(request()->get('table') == $value->name)
                                            <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                                        @else
                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">New Field</label>
                                <p class="text-muted">Especifica un nuevo campo en la tabla seleccionada.</p>
                                <input type="text" name="name" class="form-control" required placeholder="Name Field" title="Escribe el nuevo campo para esta tabla.">
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Alias</label>
                                <p class="text-muted">Especifica el alias que dará con el campo a crear.</p>
                                <input title="escribe el alias" name="alias" type="text" required class="form-control" placeholder="Alias">
                            </div>
                            <div id="contentStatusTable" class="form-group" hidden>
                                <label for="" class="control-label">Status</label>
                                <p class="text-muted">Preferencia del estado.</p>
                                <label for="chkActiveTable"><input title="activo" id="chkActiveTable" name="state" type="radio" value="A" required disabled> Active</label>
                                <label for="chkInactiveTable"><input title="inactivo" id="chkInactiveTable" name="state" type="radio" value="I" required disabled> Inactive</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSubmitCreateUpdateTable" type="submit" class="btn btn-primary">Create</button>
                    <button id="btnCloseModalCreateUpdateTable" type="button" class="btn btn-danger ">Cancel</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endif
<!-- Modal CreateUpdateUser -->
{{--@isset($type_users)--}}
    {{--<div class="modal fade" id="modalCreateUpdateUser" tabindex="-1" role="dialog" aria-labelledby="headerCreateUpdateUser" data-backdrop="static">--}}
    {{--<div class="modal-dialog modal-lg" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--{!! Form::open(['url'=>'cms/store-user','method'=>'POST','role'=>'form','id'=>'formCreateUpdateUser']) !!}--}}
            {{--<input type="hidden" name="id_user">--}}
            {{--<div class="modal-header">--}}
                {{--<h4 class="modal-title" id="headerCreateUpdateUser">Create User</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="thumbnail">--}}
                                {{--<img src="{{ PATH_APP.'upload.png' }}" alt="">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="" class="control-label">Load Profile Image</label>--}}
                            {{--<p class="text-muted">Cargar Imagen de Perfil</p>--}}
                            {{--<input type="file" class="form-control">--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="" class="control-label">Names Complete</label>--}}
                                    {{--<p class="text-muted">Nombres y Apellidos</p>--}}
                                    {{--<input name="name" type="text" class="form-control" placeholder="Name" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="" class="control-label">Email</label>--}}
                                    {{--<p class="text-muted">Correo Electronico</p>--}}
                                    {{--<input name="email" type="text" class="form-control" placeholder="Email" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="" class="control-label">Select Rol</label>--}}
                            {{--<p class="text-muted">Seleccione el Rol</p>--}}
                            {{--<select name="id_type_user" id="" class="form-control" required>--}}
                                {{--<option value="" selected disabled>Select Rol</option>--}}
                                {{--@foreach($type_users as $key => $value)--}}
                                        {{--<option value="{{ $value->id }}">{{ $value->name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="" class="control-label">Password</label>--}}
                                    {{--<p class="text-muted">Contraseña</p>--}}
                                    {{--<input name="password" type="password" class="form-control" placeholder="Password">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="" class="control-label">Re-Password</label>--}}
                                    {{--<p class="text-muted">Reingrese Password</p>--}}
                                    {{--<input name="repassword" type="password" class="form-control" placeholder="Re-Password">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="contentStatusUser" class="form-group" hidden>--}}
                            {{--<label for="" class="control-label">Status</label>--}}
                            {{--<p class="text-muted">Preferencia del estado.</p>--}}
                            {{--<label for="chkActiveUser"><input title="activo" id="chkActiveUser" name="state" type="radio" value="A" required disabled> Active</label>--}}
                            {{--<label for="chkInactiveUser"><input title="inactivo" id="chkInactiveUser" name="state" type="radio" value="I" required disabled> Inactive</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button id="btnSubmitCreateUpdateUser" type="submit" class="btn btn-primary">Create</button>--}}
                {{--<button id="btnCloseModalCreateUpdateUser" type="button" class="btn btn-danger">Cancel</button>--}}
            {{--</div>--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endisset--}}
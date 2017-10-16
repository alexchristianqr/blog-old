<!-- Modal SelectCreatePost -->
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
                                <label for="chkActiveTable"><input title="activo" id="chkActiveTable" name="status" type="radio" value="A" required disabled> Active</label>
                                <label for="chkInactiveTable"><input title="inactivo" id="chkInactiveTable" name="status" type="radio" value="I" required disabled> Inactive</label>
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
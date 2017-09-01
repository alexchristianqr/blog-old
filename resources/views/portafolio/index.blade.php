@extends('layouts.web.master',["title"=>"Portafolio | Home"])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Portafolio | Home</h1>
                <div><br></div>


                <div class="input-group">
                    <input id="autocomplete" name="nombre" value="{{ old('nombre') }}" placeholder="escribir nombre"  type="text" class="form-control" required>
                    <div class="input-group-btn not-visible">
                        <button type="button" id="btnDeleteAutocomplete" class="btn btn-danger btn-sm "><i class="fa fa-times fa-fw"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
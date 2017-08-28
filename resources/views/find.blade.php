@extends('layouts.web.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <div class="title">
                        <h2><a href="#">seccion de busqueda</a></h2>
                        <form id="search" method="get" action="#" class="form-inline">
                            <input type="text" name="query" placeholder="buscar palabra" class="form-control input-lg" style="width: 500px"/>
                            <a href="#" class="btn btn-default btn-lg" style="border-radius: 0;padding:12px 16px"><i class="fa fa-search"></i></a>
                        </form>
                    </div>
                </header>
                <table class="table-bordered table-hover">
                    @for($i = 0;$i<10;$i++)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="thumbnail" style="margin-bottom: 0">
                                            <img src="{{ asset('images/x100/laravel_x100.png') }}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <header>
                                            <h3><a href="#">LARAVEL 5.5 FRAMEWORK PARA PHP</a></h3>
                                            <p>
                                                <span class="to-lowercase">publicado el </span>{{ Jenssegers\Date\Date::parse(Carbon\Carbon::now())->format('d F Y') }}
                                            </p>
                                            <p>Tipo : Tecnologia de Informacion</p>
                                        </header>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
    </div>
@endsection
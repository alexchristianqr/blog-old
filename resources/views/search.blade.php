@extends('layouts.web.master')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        {{--<button  type="button" data-toggle="modal" data-target="#modalAgregarProducto">--}}
        {{--Launch demo modal--}}
        {{--</button>--}}

        {{--<a data-target="#modalAgregarProducto" class="btn btn-primary btn-sm" data-toggle="modal">modal</a>--}}

        <div hidden class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog">
            <div class="modal-dialog w-50e">
                <div class="modal-content">
                    <div class="modal-header text-left">
                        <span class="close" data-dismiss="modal">&times;</span>
                        {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                        <h2>suscripcion</h2>
                    </div>
                    <div class="modal-body">
                        <p>desea usted suscribirse a nuestro boletin de mensajeria.</p>
                    </div>
                    <div class="modal-footer">
                        <input type="text" value="text">
                        <button type="button" class="button">acepto</button>
                    </div>
                </div>
            </div>
        </div>

        <h1>repositorios</h1>
        <div class="row">
            <form id="search" method="GET" action="{{ url('search') }}" class="form-horizontal">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="input-group">
                        <input type="text" name="query" placeholder="buscar palabra" class="form-control"
                               value="{{ old('query',$text_search) }}"/>
                        <div class="input-group-btn" style="font-size: inherit;">
                            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div><br></div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    @if(count($data) < 1)
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <article class="content-search">
                                    <div class="text-center">
                                        <span><i class="fa fa-exclamation fa-fw"></i>no hay registros.</span>
                                    </div>
                                </article>
                            </div>
                        </div>
                    @else
                        @foreach($data as $value )
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <article class="content-search">
                                        <header>
                                            <h3><a href="#"><span>{{ $value->title }}</span></a></h3>
                                        </header>
                                        <footer>
                                            <div class="row">
                                                <div class="col-xs-7 col-sm-7 col-md-7 text-left">
                                                    <span><i class="fa fa-user"></i>&nbsp;Alex Christian</span>
                                                </div>
                                                <div class="col-xs-5 col-sm-5 col-md-5 text-right">
                                                    <span><i class="fa fa-clock-o"></i>&nbsp;2017-08-31</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                    <div class="form-group">
                                                        <div><br></div>
                                                        <button class="button-reverse btn-block">ver post</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </footer>
                                    </article>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
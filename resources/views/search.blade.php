@extends('layouts.web.master')
@section('content')
    <section id="view-search">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <h3>REPOSITORIOS</h3>
                <form method="GET" action="{{ url('search') }}" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12 col-md-12">
                            <input type="search" name="query" placeholder="buscar" class="form-control" value="{{ old('query',$search) }}" maxlength="25" minlength="3" autofocus required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-md-12">
                            @if(count($data))
                                @foreach($data as $key => $value)
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <article class="content-search">
                                                <header>
                                                    <h3>
                                                        <a title="post" href="{{ url('post/show',['id' => $value->id,'id_category'=>$value->id_category]) }}">{{ $value->title }}</a>
                                                    </h3>
                                                    <time class="published">
                                                        <span title="usuario y/o invitado" class="name"><span class="to-lowercase"><i class="fa fa-user"></i>&nbsp;</span>{{ $value->user_name }}</span><br>
                                                        <span title="fecha de creación"><i class="fa fa-calendar-o"></i>&nbsp;{{ Jenssegers\Date\Date::parse($value->date_publication)->format('d F Y') }}</span>
                                                    </time>
                                                    <a class="author"><img class="img-profile" src="{{ ASSET_USERS.$value->user_image }}"></a>
                                                </header>
                                            </article>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-xs-12 col-md-12">
                                    <div class="text-right">
                                        {!! $data->appends($_GET)->render() !!}
                                    </div>
                                </div>
                            @else
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <article class="content-search">
                                            <div class="text-center">
                                                <p style="margin: 0 0 1em 0;">
                                                    <span><i class="fa fa-exclamation-circle fa-fw"></i>No hay registros.</span>
                                                </p>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
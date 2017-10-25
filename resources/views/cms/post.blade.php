@extends('layouts.cms.app',['title'=>'Post'])
@section('content')
    <section id="section-cms-post">

        @isset(session('session_roles')->role_post_update)
            @isset($data)
                {!! Form::model($data, ['url' => ['cms/update-post', $data->id], 'method' => 'PUT','role'=>'form', 'files'=>'true','id'=>'formUpload']) !!}
                @include('cms.post-create-edit')
                {!! Form::close() !!}
            @endisset
        @endisset

        @isset(session('session_roles')->role_post_create)
            @empty($data)
                {!! Form::open(['url' => 'cms/store-post','method'=>'POST','role'=>'form', 'files'=>'true','id'=>'formUpload']) !!}
                @include('cms.post-create-edit')
                {!! Form::close() !!}
            @endempty
        @endisset

    </section>
@endsection
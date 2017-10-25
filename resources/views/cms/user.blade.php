@extends('layouts.cms.app',['title'=>'User'])
@section('content')
    <section id="section-cms-user">

        @isset(session('session_roles')->role_user_update)
            @isset($data)
                {!! Form::model($data, ['url' => ['cms/update-user', $data->id], 'method' => 'PUT','role'=>'form', 'files'=>'true']) !!}
                <input type="hidden" name="id_user" value="{{ $data->id }}">
                @include('cms.user-create-edit')
                {!! Form::close() !!}
            @endisset
        @endisset

        @isset(session('session_roles')->role_user_create)
            @empty($data)
                {!! Form::open(['url' => 'cms/store-user','method'=>'POST','role'=>'form', 'files'=>'true']) !!}
                @include('cms.user-create-edit')
                {!! Form::close() !!}
            @endempty
        @endisset

    </section>
@endsection

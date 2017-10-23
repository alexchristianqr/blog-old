@extends('layouts.error',['error'=>503])
@section('content')
    <div class="content">
        <div class="title">Service Unavailable</div>
        <p>
            <span>The server is currently unable to handle the request due to a temporary overload or scheduled maintenance, which will likely be alleviated after some delay</span>
        </p>
    </div>
@endsection
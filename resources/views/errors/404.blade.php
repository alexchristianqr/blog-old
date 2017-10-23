@extends('layouts.error',['error'=>404])
@section('content')
    <div class="content">
        <div class="title">Page not found</div>
        <p>
            <span>The origin server did not find a current representation for the target resource or is not willing to disclose that one exists</span>
        </p>
    </div>
@endsection
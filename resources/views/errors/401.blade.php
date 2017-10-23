@extends('layouts.error',['error'=>401])
@section('content')
    <div class="content">
        <div class="title">User Unauthorized</div>
        <p>
            <span>The request has not been applied because it lacks valid authentication credentials for the target resource</span>
        </p>
    </div>
    <script>
        setTimeout(function () {
            @php auth()->logout(); @endphp
        },100)
    </script>
@endsection
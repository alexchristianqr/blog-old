<title>{{ (!isset($title) ? 'admin | Home' : 'admin | ' . $title) }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--Store CSRF token for AJAX calls--}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(env('APP_ENV') == 'local')
    <link href="{{asset('admin/css/styles.dev.css')}}" rel="stylesheet">
@else
    <link href="{{asset('admin/css/styles.min.css')}}" rel="stylesheet">
@endif
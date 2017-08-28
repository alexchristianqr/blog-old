<title>{{ (!isset($title) ? 'Blog' : $title) }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Store CSRF token for AJAX calls -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@if(env('APP_ENV') == 'local')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.dev.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
@endif
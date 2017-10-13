<title>{{ (!isset($title) ? 'Blog | Web' : $title) }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- Store CSRF token for AJAX calls -->
<meta name="csrf_token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Raleway:400,800,900">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

@if(env('APP_ENV') == 'local')
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/social-share-kit/dist/css/social-share-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.dev.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.dev.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
@endif
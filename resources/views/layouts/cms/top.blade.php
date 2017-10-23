<title>{{ (!isset($title) ? 'cms' : 'cms | ' . $title) }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- csrf_token -->
<meta name="csrf_token" content="{{ csrf_token() }}">

@if(env('APP_ENV') == 'local')
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/metisMenu/dist/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public_cms/css/sb-admin-2.css') }}">
    <link rel="stylesheet" href="{{ asset('public_cms/css/styles.css') }}">
@else
    <link href="{{asset('public_cms/css/styles.min.css')}}" rel="stylesheet">
@endif
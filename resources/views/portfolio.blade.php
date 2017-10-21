<!DOCTYPE HTML>
<html>
<head>
    <title>Portafolio</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Raleway:400,800,900">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
    @if(env('APP_ENV') == 'local')
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public_portfolio/assets/css/main.css') }}"/>
        <link rel="stylesheet" href="{{ asset('public_portfolio/css/styles.css') }}"/>
    @else
        <link rel="stylesheet" href="{{ asset('public_portfolio/css/styles.min.css') }}">
    @endif
</head>
<body>
<div id="wrapper">
    <div id="main" style="border: 1px solid rgba(160,160,160,.3);">
        <div id="reel">
            <!-- Header Item -->
            <div id="header" class="item" data-width="600">
                <div class="inner">
                    <h2>PORTAFOLIO</h2>
                    <p><span>Implementation of software by Front-End and Back-End in languages how Php, Java, Javascript and Plugins.</span>
                    </p>
                </div>
            </div>
        @isset($data)
            @if(count($data))
            @foreach($data as $value)
                <!-- Thumb Items -->
                    <article class="item thumb" data-width="{{ $value->width }}">
                        <h2>{{ $value->title }}</h2>
                        <a href="{{ ASSET_PORTFOLIOS.$value->image }}" class="image">
                            <img src="{{ ASSET_PORTFOLIOS.$value->image }}">
                        </a>
                    </article>
                @endforeach
            @else
                    <article class="item thumb" data-width="300">
                        <h2>Test Image Portfolio</h2>
                        <a href="test" class="image">
                            <img src="test" alt="image">
                        </a>
                    </article>
                @endif
            @endisset
        </div>
    </div>
    <div id="footer">
        <div class="end">
            <a title="salir de la seccion portafolio" href="{{ url('/') }}" class="button">SALIR</a>
        </div>
    </div>
</div>

<!-- Scripts -->
@if(env("APP_ENV") == 'local')
    <script src="{{ asset('bower_components/requirejs/require.js') }}"
            data-main="{{ asset('public_portfolio/main_portfolio.js') }}"></script>
@else
    <script src="{{ asset('public_portfolio/js/app.min.js') }}"></script>
@endif

</body>
</html>
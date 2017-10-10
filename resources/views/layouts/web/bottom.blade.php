@if(env("APP_ENV") == 'local')
    <script src="{{ asset('bower_components/requirejs/require.js') }}" data-main="{{ asset('main.js') }}"></script>
@else
    <script src="{{ asset('js/app.min.js') }}"></script>
@endif
{{--<script id="dsq-count-scr" src="//aquispe.disqus.com/count.js" async></script>--}}
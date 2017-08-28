@if(env('APP_ENV') == 'local')
    <script src="{{ asset('bower_components/requirejs/require.js') }}" data-main="{{ asset('main.js') }}"></script>
@else
    <script src="{{ asset('js/app.min.js') }}"></script>
@endif

@foreach(glob(str_replace('\storage\framework\views','\public\template',__DIR__).'\*.html') as $filename)
    @php
        require_once $filename;
    @endphp
@endforeach
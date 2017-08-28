@if(env('APP_ENV') == 'local')
    <script src="{{ asset('bower_components/requirejs/require.js') }}" data-main="{{ asset('admin/main.js') }}"></script>
@else
    <script src="{{ asset('admin/js/app.min.js?cache=' . str_limit(time(), 6, '')) }}"></script>
@endif

@foreach(glob(str_replace('\storage\framework\views','\public\template',__DIR__).'\*.html') as $filename)
    @php
        require_once $filename;
    @endphp
@endforeach
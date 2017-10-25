/**
 * Created by QuispeRoque on 28/04/17.
 */
var rootURL = location.origin + '/',
    path = location.pathname.split('/'),
    csrf_token = {}, $elem;

require.config({
    paths: {
        'jquery': '../bower_components/jquery/dist/jquery.min',//v2.2.4
        'bootstrap': '../bower_components/bootstrap/dist/js/bootstrap.min',
        'metisMenu': '../bower_components/metisMenu/dist/metisMenu',
        'raphael': '../bower_components/eve-raphael/eve',
        'jqueryzoom': '../node_modules/jquery-zoom/jquery.zoom.min'
    },
    shim: {
        'bootstrap': ['jquery'],
        'jqueryzoom': ['jquery'],
        'metisMenu': ['jquery', 'bootstrap', 'raphael']
    }
});

require([
    'jquery',
    'bootstrap',
    'metisMenu',
    'jqueryzoom',
    'js/sb-admin-2',
    'js/app'
], function ($) {

    $.extend(csrf_token, {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')});

    $elem = $('.nav a.active');

    if (path[1] === '') {
        $elem.addClass('active');
        $elem.attr('href', 'javascript:;');
    } else {
        if ($elem.attr('href') == location.href) {
            $elem.closest('.href').addClass('active');
            $elem.attr('href', 'javascript:;');
        }
    }

    $('.thumbnail').zoom(); // add zoom

});
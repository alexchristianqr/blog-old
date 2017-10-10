/**
 * Created by QuispeRoque on 28/04/17.
 */
var rootURL = location.origin + '/',
    path = location.pathname.split('/'),
    csrf_token = {}, $elem;

require.config({
    paths: {
        'jquery': '../bower_components/jquery/dist/jquery.min',
        'underscore': '../bower_components/underscore/underscore-min',
        'bootstrap': '../bower_components/bootstrap/dist/js/bootstrap.min',
        'bootstrap-datetimepicker': '../bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker',
        'bootpag': '../bower_components/bootpag/lib/jquery.bootpag.min',
        'autocomplete': '../bower_components/devbridge-autocomplete/dist/jquery.autocomplete.min',
        'moment': '../bower_components/moment/min/moment-with-locales',
        'metisMenu': '../bower_components/metisMenu/dist/metisMenu',
        'raphael': '../bower_components/eve-raphael/eve',
        'standalone': '../bower_components/fastselect/dist/fastselect.standalone'
    },
    shim: {
        'bootstrap': ['jquery'],
        'bootstrap-datetimepicker': ['jquery', 'bootstrap'],
        'bootpag': ['jquery'],
        'metisMenu': ['jquery', 'bootstrap', 'raphael']
    }
});

require([
    'jquery',
    'bootstrap',
    'metisMenu',
    'js/sb-admin-2',
    'js/AppController'
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

});


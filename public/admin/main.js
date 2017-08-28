/**
 * Created by QuispeRoque on 28/04/17.
 */
var rootURL = location.origin + '/',
    path = location.pathname.split('/'),
    csrf_token = {}, $elem;

require.config({
    paths: {
        'jquery': '../bower_components/jquery/dist/jquery',
        'underscore': '../bower_components/underscore/underscore-min',
        'backbone': '../bower_components/backbone/backbone',
        'bootstrap': '../bower_components/bootstrap/dist/js/bootstrap.min',
        'bootstrap-datetimepicker': '../bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker',
        'bootpag': '../bower_components/bootpag/lib/jquery.bootpag.min',
        'autocomplete': '../bower_components/devbridge-autocomplete/dist/jquery.autocomplete.min',
        'moment': '../bower_components/moment/min/moment-with-locales',
        'metisMenu': '../bower_components/metisMenu/dist/metisMenu',
        'raphael': '../bower_components/eve-raphael/eve',
        'utility': '../js/Utility'
        // 'autosize':'../node_modules/autosize/dist/autosize.min',
        // 'codemirror':'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min',
        // 'xml':'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min',
        // 'froala_editor': '../bower_components/froala-wysiwyg-editor/js/froala_editor.pkgd.min',
    },
    shim: {
        'backbone': ['jquery', 'underscore'],
        'bootstrap': ['jquery'],
        'bootstrap-datetimepicker': ['jquery', 'bootstrap'],
        'bootpag': ['jquery'],
        'metisMenu': ['jquery', 'bootstrap', 'raphael']
    }
});

// require(['https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.min.js']);
require([
        'jquery',
        'bootstrap',
        'metisMenu'
    ],
    function ($) {

        $.extend(csrf_token, {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')});
        $elem = $('.nav a.active');
        if (path[1] === '') {
            $elem.addClass('active');
        } else {
            if ($elem.attr('href') == location.href) {
                $elem.closest('.href').addClass('active');
            }
        }

    });


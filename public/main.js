/**
 * Created by QuispeRoque on 21/08/17.
 */

var rootURL = location.origin + '/',
    path = location.pathname.split('/'),
    csrf_token = {}, $elem, _token, $meta;

require.config({
    paths: {
        'jquery': 'bower_components/jquery/dist/jquery.min',
        'underscore': 'bower_components/underscore/underscore-min',
        'backbone': 'bower_components/backbone/backbone',
        'bootstrap': 'bower_components/bootstrap/dist/js/bootstrap.min',
        'bootstrap-datetimepicker': 'bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker',
        'bootpag': 'bower_components/bootpag/lib/jquery.bootpag.min',
        'autocomplete': 'bower_components/devbridge-autocomplete/dist/jquery.autocomplete.min',
        'moment': 'bower_components/moment/min/moment-with-locales',
        'skel': 'assets/js/skel.min',
        'util': 'assets/js/util',
        'menu': 'assets/js/main',
        'prism': 'lib/prismjs/prism',
        'linenumber': 'lib/prismjs/prism.linenumber',
        'highlight': 'lib/prismjs/prism-line-highlight',
        'toastr': 'bower_components/toastr/toastr'
    },
    shim: {
        'util': ['jquery'],
        'menu': ['skel', 'util'],
        'backbone': ['jquery', 'underscore'],
        'bootstrap': ['jquery'],
        'bootpag': ['jquery'],
        'toastr': ['jquery']
    }
});

require(['jquery','bootstrap', 'prism', 'menu', 'js/controller/AppController'], function ($) {
    // toastr.options.positionClass = 'toast-top-center'

    // toastr.options = {
    //     positionClass:'toast-top-center'
    // };
    // toastr.success( 'mensaje enviado correctamente!');
});
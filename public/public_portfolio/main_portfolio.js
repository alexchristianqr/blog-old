/**
 * Created by QuispeRoque on 21/08/17.
 */
require.config({
    paths: {
        'jquery': '../bower_components/jquery/dist/jquery.min',//v2.2.4
        'jquerypoptrox': '../public_portfolio/assets/js/jquery.poptrox.min',
        'skel': '../lib/skel.min',
        'skelview': '../public_portfolio/assets/js/skel-viewport.min',
        'utils': '../public_portfolio/assets/js/util',
        'menu': '../public_portfolio/assets/js/main'
    },
    shim: {
        'jquerypoptrox':['jquery'],
        'utils':['jquery'],
        'menu':['skel','skelview','utils'],
    }
});

require([
    'jquerypoptrox',
    'menu'
], function ($) {});
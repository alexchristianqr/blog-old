/**
 * Created by QuispeRoque on 21/08/17.
 */
var rootURL = location.origin + '/', path = location.pathname.split('/'), csrf_token = {}, _token, $elem;

require.config({
    waitSeconds: 120,
    paths: {
        'jquery': 'bower_components/jquery/dist/jquery.min',//v2.2.4
        'jquerycookie': 'bower_components/jquery.cookie/jquery.cookie',
        'underscore': 'bower_components/underscore/underscore-min',
        'backbone': 'bower_components/backbone/backbone',
        'bootstrap': 'bower_components/bootstrap/dist/js/bootstrap.min',
        'bootstrap-datetimepicker': 'bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker',
        'bootpag': 'bower_components/bootpag/lib/jquery.bootpag.min',
        'autocomplete': 'bower_components/devbridge-autocomplete/dist/jquery.autocomplete.min',
        'moment': 'bower_components/moment/min/moment-with-locales',
        'skel': 'lib/skel.min',
        'util': 'assets/js/util',
        'menu': 'assets/js/main',
        'socialsharekit': 'bower_components/social-share-kit/dist/js/social-share-kit.min',
        'metisMenu': 'bower_components/metisMenu/dist/metisMenu',
        'raphael': 'bower_components/eve-raphael/eve'
    },
    shim: {
        'util': ['jquery'],
        'menu': ['skel', 'util'],
        'bootstrap': ['jquery'],
        'bootpag': ['jquery'],
        'socialsharekit': ['jquery'],
        'jquerycookie': ['jquery'],
        'moment': ['jquery'],
        'metisMenu': ['jquery', 'bootstrap', 'raphael']
    }
});

require([
    'jquery',
    'bootstrap',
    'jquerycookie',
    'menu',
    'metisMenu',
    'socialsharekit',
    'js/sb-admin-2',
    'js/app'
], function ($) {

    // X-CSRF-TOKEN
    $.extend(csrf_token, {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')});

    // Social Share Kit
    var url = $('meta[property="og:url"]').attr('content'),
        image = $('meta[property="og:image"]').attr('content'),
        title = $('meta[property="og:title"]').attr('content'),
        text = $('meta[property="og:description"]').attr('content'),
        obj = {url: url, image: image, title: title, text: text};
    SocialShareKit.init({
        twitter: obj,
        facebook: obj,
        google: obj,
    });
    function popupCenter(url, target, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = 100;
        return window.open(url, target, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }

    // Whatsapp
    $('.ssk-whatsapp').on('click', function () {
        event.preventDefault();
        return window.open('https://api.whatsapp.com/send?phone=51955588297&text=' + encodeURI('Continuar para iniciar la conversacion con http://aquispe.com'),'_blank');
    });
    // Github
    $('.ssk-github').on('click', function () {
        event.preventDefault();
        return window.open('https://github.com/acqrdeveloper','_blank');
    });

    //config link .active
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
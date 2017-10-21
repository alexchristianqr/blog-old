/**
 * Created by aquispe on 18/10/2017.
 */
define([
    'jquery',
    'js/Utility',
], function ($, Utility) {

    var Ctrl;
    var ViewPost = $('#view-post').length;
    var Body = $('body').length;

    if (Body) {
        var $btnUp = $('#btnUp');
        Ctrl = {
            start: function () {
                Ctrl.init();
            },
            init: function () {
                // Initialize
                if (window.scrollY >= 100) {
                    $btnUp.removeClass('hidden').fadeIn();
                } else {
                    $btnUp.addClass('hidden').fadeOut();
                }
                $btnUp.on('click', function () {
                    event.preventDefault();
                    $("body, html").animate({scrollTop: '0'}, 800);
                    $btnUp.removeClass('hidden');
                });
                $(window).on('scroll', function () {
                    event.preventDefault();
                    if ($(this).scrollTop() >= 200) {
                        $btnUp.removeClass('hidden').fadeIn();
                    } else {
                        $btnUp.addClass('hidden').fadeOut();
                    }
                });
                // Show/Hide Password
                $('.btnEyesPassword').on('click', Ctrl.fnButtonEyesPwd);
            },
            fnButtonEyesPwd: function () {
                event.preventDefault();
                var eye = $('.btnEyesPassword > i'), password = $('[name="password"]');
                if (password.val() != "") {
                    if (eye.hasClass('fa fa-eye-slash')) {
                        eye.attr('class', 'fa fa-eye');
                        password.attr('type', 'password');
                    } else {
                        eye.attr('class', 'fa fa-eye-slash');
                        password.attr('type', 'text');
                    }
                } else {
                    event.preventDefault();
                }
            }
        };
        Ctrl.start();
    }

    if (ViewPost) {
        var cont_util = 0,
            cont_inutil = 0,
            bool_util = true,
            bool_inutil = true,
            cookie_community = $.cookie('cookie_community');
        Ctrl = {
            start: function () {
                Ctrl.init();
            },
            init: function () {
                Ctrl.fnGetCounts();
                if (cookie_community === undefined) {//si es undefined
                    $('#btnUtil').on('click', Ctrl.fnUtil);
                    $('#btnInutil').on('click', Ctrl.fnInutil);
                } else {//si es true/false
                    $('#btnUtil').addClass('disabled');
                    $('#btnInutil').addClass('disabled');
                    $('#btnUtil').on('click', function () {
                        event.preventDefault();
                    });
                    $('#btnInutil').on('click', function () {
                        event.preventDefault();
                    });
                }
            },
            fnGetCounts: function () {
                $.ajax({
                    url: '/get/counts',
                    type: 'GET',
                    data: {id_post: $('#id_post').val()}
                }).done(function (r) {
                    if (r.load) {
                        cont_util = r.data.util;
                        cont_inutil = r.data.inutil;
                        $('#btnUtil span').text(cont_util);
                        $('#btnInutil span').text(cont_inutil);
                        if (cookie_community == true) {
                            $('#btnUtil').addClass('disabled');
                            $('#btnInutil').addClass('disabled');
                        }
                    }
                }).fail(function () {
                    Utility.fnCatch(r);
                });
            },
            fnUtil: function () {
                event.preventDefault();
                var $this = $(this),
                    $badge = $this.find('span'),
                    $community = $this.data('community'),
                    value = parseInt($badge.text()) || 0;
                if ($this.hasClass('disabled')) {
                    return false;
                }
                if (bool_util) {
                    // $this.addClass('badge-blue');
                    cont_util = value + 1;
                    $('#btnInutil').addClass('disabled');
                } else {
                    // $this.removeClass('badge-blue');
                    cont_util = value - 1;
                    $('#btnInutil').removeClass('disabled');
                }
                bool_util = !bool_util;
                $badge.text(cont_util);
                Ctrl.fnUpdateCounts($community, bool_util);
            },
            fnInutil: function () {
                event.preventDefault();
                var $this = $(this),
                    $badge = $this.find('span'),
                    $community = $this.data('community');
                if ($this.hasClass('disabled')) {
                    return false;
                }
                var value = parseInt($badge.text()) || 0;
                if (bool_inutil) {
                    // $this.addClass('badge-red');
                    cont_inutil = value + 1;
                    $('#btnUtil').addClass('disabled');
                } else {
                    // $this.removeClass('badge-red');
                    cont_inutil = value - 1;
                    $('#btnUtil').removeClass('disabled');
                }
                bool_inutil = !bool_inutil;
                $badge.text(cont_inutil);
                Ctrl.fnUpdateCounts($community, bool_inutil);
            },
            fnUpdateCounts: function ($community, push_utilidad) {
                var $request = {id_post: $('#id_post').val(), tipo: $community};
                switch ($community) {
                    case 'util':
                        $.extend($request, {valor: cont_util});
                        break;
                    default://inutil
                        $.extend($request, {valor: cont_inutil});
                        break;
                }
                $.ajax({
                    headers: csrf_token,
                    url: '/update/counts',
                    type: 'PUT',
                    data: $request
                }).done(function (r) {
                    if (push_utilidad) {//TRUE 1 push button
                        $.removeCookie('cookie_community');
                    } else {//FALSE 2 push button
                        var date = new Date(), minutes = 720;
                        date.setTime(date.getTime() + (minutes * 60 * 1000));
                        $.cookie('cookie_community', r, {expires: date, path: location.href});
                    }
                }).fail(function (r) {
                    Utility.fnCatch(r);
                });
            }
        };
        Ctrl.start();
    }

    return Ctrl;

});
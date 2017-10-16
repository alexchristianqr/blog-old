/**
 * Created by aquispe on 28/07/2017.
 */
define([
    'jquery',
    'js/app/helps/Utility',
], function ($) {

    var $btnUp = $('#btnUp');

    if ($('body')) {

        var Ctrl = {
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

    return Ctrl;

});
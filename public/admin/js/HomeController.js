/**
 * Created by aquispe on 14/08/2017.
 */

define([
    'jquery',
    'underscore',
    'backbone',
    'utility'
], function ($, _, Backbone, Util) {

    var Ctrl, sectionCreate = $('#create').length, sectionEdit = $('#edit').length, sectionList = $('#list').length,
        sectionChange = $('#change').length, ListView, varListView;

    if ($('#wrapper')) {
        Ctrl = {
            start: function () {
                Ctrl.init();
            },
            init: function () {
                $('#btnTitulo').on('click',function () {
                    var html = $('#txtTitulo').val(),
                        transform = '<h1>'+html+'</h1>';
                    console.log(transform);
                    return false;
                });
            },
            test: function () {

            }
        };
        Ctrl.start();
    }

    return Ctrl;

});

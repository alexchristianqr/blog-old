/**
 * Created by aquispe on 28/07/2017.
 */
define([
    'jquery',
    'underscore',
    'backbone',
    'js/utility',
    'toastr',
    'bootpag',
], function ($, _, Backbone, Utility, toastr) {

    var Ctrl,
        sectionCreate = $('#create').length,
        sectionEdit = $('#edit').length,
        sectionList = $('#list').length,
        sectionChange = $('#change').length,
        ListView,
        varListView, vm = {
            request: {
                limite: parseInt(Utility.limite),
                pagina: parseInt(Utility.pagina),
                estado: 'A'
            },
            temp: {
                ids: [],
                validator: false
            }
        };

    if ($('#wrapper')) {
        Ctrl = {
            start: function () {
                Ctrl.init();
            },
            init: function () {

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-full-width",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                if ($('#formSendEmailSuscription').length) {
                    $('#btnSendEmailSuscription').on('submit', function () {
                        event.preventDefault();
                        var $email = $('[name="email_suscripcion"]');

                        if ($email.val().length > 0) {
                            toastr.success('mensaje enviado para ' + $email.val());
                            return false;
                        }
                    });
                }
                $('.btnEyesPassword').on('click', function () {
                    event.preventDefault();
                    var eye = $('.btnEyesPassword>i'), password = $('[name="password"]');
                    if (password.val() != "") {
                        if (eye.hasClass('fa fa-eye-slash')) {
                            eye.attr('class', 'fa fa-eye');
                            password.attr('type', 'password');
                        } else {
                            eye.attr('class', 'fa fa-eye-slash');
                            password.attr('type', 'text');
                        }
                    } else {
                        return false;
                    }
                });

                var r = [
                    { value: 'Alex Quispe Roque', data: 'ALEX' },
                    { value: 'Alex Quispe Roque', data: 'ALEX' },
                    { value: 'Alex Quispe Roque', data: 'ALEX' },
                    { value: 'Alex Quispe Roque', data: 'ALEX' },
                    { value: 'Alex Quispe Roque', data: 'ALEX' },
                    { value: 'Alex Quispe Roque', data: 'ALEX' },
                    { value: 'Deysi Quispe Roque', data: 'DEYSI' }
                ];
                Utility.fnAutocomplete(r, '#autocomplete', '#btnDeleteAutocomplete');

            },
            fnApplyChange: function (num) {
                // inicializar  o cambiar variables
                Utility.totalItems = 0;
                vm.request.pagina = (num == undefined) ? parseInt(Utility.pagina) : parseInt(num);
                vm.request.limite = parseInt(Utility.limite);
                // parametros REQUEST
                // $.extend(vm.request, {
                //     filter: $('#idChangeFilter').val(),
                //     txt: $('#idTxtSearch').val(),
                //     estado: $('#utilChangeEstado').val(),
                //     tipo: $('#idChangeTipo').val()
                // });
                Ctrl.fnGetListAll();
            },
            fnGetListAll: function () {
                // var template = _.template($('#tplTbodyClienteList').html()), html;
                $.ajax({
                    url: 'post/get-posts',
                    type: 'GET',
                    data: vm.request
                    // beforeSend: function () {
                    //     $('#tbodyClienteList').html(Utility.fnloadingTable(8, 'cargando...'));
                    // }
                }).done(function (r) {
                    console.log(r);
                    if (r.load) {
                        if (r.data.data.length) {
                            Utility.totalItems = r.data.total;
                            // $.each(r.data.data, function (key, value) {
                            //     html += template(value);
                            // });
                            // $('#tbodyClienteList').html(html);
                        } else {
                            r.data.data = [];
                            Utility.totalItems = 0;
                            vm.request.pagina = 1;
                            // $('#tbodyClienteList').html(Utility.fnfailedTable(8));
                        }
                        Utility.fnBootpag($('#pagination-here'), null, r.data);
                    }
                }).fail(function (r) {
                    Utility.fnCatch(r);
                    // $('#tbodyClienteList').html(Utility.fnfailedTable(8));
                })
            }
        };
        Ctrl.start();
    }

    return Ctrl;

});
/**
 * Created by aquispe on 14/08/2017.
 */

define([
    'jquery'
], function ($) {

    var Ctrl, ids = [], validate = false;

    if ($('body')) {
        Ctrl = {
            start: function () {
                Ctrl.init();
            },
            init: function () {
                // If Exist Section Posts
                if ($('#section-cms-posts').length) {
                    // Toggle all table actions
                    $('#chkAll').on('click', Ctrl.fnCheckedAll);
                    // Only allow actions if rows are selected.
                    $('.chkOnly').on('click', Ctrl.fnChecked);
                    // Alerta para eliminar
                    $('#btnDelete').on('click', Ctrl.fnDeletePosts);
                }
                // If Exist Section Post
                if ($('#section-cms-post').length) {
                    // Replace String
                    $('#txtTitle').on('keyup', function () {
                        Ctrl.fnCleanSpace($(this).val(), $('#txtSlug'));
                    });
                    // get Checkeds si espara Crear
                    var chkbxs = [], chkbxs2 = [], $inputCheckbox = $('.tag-chk');
                    if (!$inputCheckbox.is(':checked')) {
                        $('.tag-chk').each(function (k, v) {
                            chkbxs.push({id: $(v).val(), value: false});
                            $('[name="id_tag"]').val(JSON.stringify(chkbxs));
                        });
                    }
                    // recorremos Checkeds si es edicion
                    $inputCheckbox.on('click', function () {
                        var $this = $(this);
                        chkbxs2 = $.parseJSON($('[name="id_tag"]').val());
                        if ($this.is(':checked')) {
                            $this.prop('checked', true);
                            $.each(chkbxs2, function (k, v) {
                                if (v.id == $this.val()) {
                                    chkbxs2[k].value = true;
                                    return false;
                                }
                            });
                        } else {
                            $this.prop('checked', false);
                            $.each(chkbxs2, function (k, v) {
                                if (v.id == $this.val()) {
                                    chkbxs2[k].value = false;
                                    return false;
                                }
                            });
                        }
                        $('[name="id_tag"]').val(JSON.stringify(chkbxs2));
                    });
                    // var modified = null;
                    // $("input, select, textarea").on('change', function () {
                    //     modified = true;
                    // });
                    // window.onbeforeunload = function () {
                    //     return modified;
                    // };
                }
                // If Exist Modal for Tables
                if ($('#modalCreateUpdateTable').length) {
                    // Open Edit Modal and Close Modal
                    $('.btnModalEditTable').on("click", function () {
                        event.preventDefault();
                        $.ajax({
                            url: $(this).attr('href'),
                            type: 'GET',
                            data: null
                        }).done(function (r) {
                            $('[name="id_field_table"]').prop('disabled', false);
                            $('[name="id_table"]').prop('disabled', false);
                            $('#chkActiveTable').prop('disabled', false);
                            $('#chkInactiveTable').prop('disabled', false);
                            $('[name="table"]').prop('disabled', true);

                            $('[name="id_table"]').val($('[name="table"]').val());
                            $('[name="id_field_table"]').val(r.data.id);
                            $('[name="name"]').val(r.data.name);
                            $('[name="alias"]').val(r.data.alias);

                            if (r.data.state == 'A') {
                                $('#chkActiveTable').attr('checked', true);
                                $('#chkActiveTable').prop('checked', true);
                            } else {
                                $('#chkInactiveTable').attr('checked', true);
                                $('#chkInactiveTable').prop('checked', true);
                            }
                            $('#formCreateUpdateTable').attr('action', rootURL + 'cms/update-table/' + $('[name="table"]').val() + '/' + r.data.id);
                            $('#formCreateUpdateTable').attr('method', 'POST');
                            $('#headerCreateUpdateTable').text('Edit Field Table');
                            $('#contentStatusTable').prop('hidden', false);
                            $('#btnSubmitCreateUpdateTable').text('Update');
                            $('#modalCreateUpdateTable').modal({backdrop: 'static'});
                        });
                    });
                    $('#btnCloseModalCreateUpdateTable').on('click', function () {
                        event.preventDefault();
                        $('#formCreateUpdateTable').attr('action', rootURL + 'cms/store-table');
                        $('#formCreateUpdateTable').attr('method', 'POST');
                        $('#headerCreateUpdateTable').text('Create Field Table');
                        $('#contentStatusTable').prop('hidden', true);
                        $('#chkActiveTable').prop('disabled', true);
                        $('#chkInactiveTable').prop('disabled', true);
                        $('[name="id_field_table"]').prop('disabled', true);
                        $('[name="table"]').prop('disabled', false);
                        $('[name="id_table"]').prop('disabled', true);
                        $('[name="state"]').removeAttr('checked');
                        $('[name="id_field_table"]').val('');
                        $('[name="id_table"]').val('');
                        $('#formCreateUpdateTable')[0].reset();
                        $('#btnSubmitCreateUpdateTable').text('Create');
                        $('#modalCreateUpdateTable').modal('hide');
                    });
                }
                // If Exist Modal for Users
                if ($('#modalCreateUpdateUser').length) {
                    // Open Edit Modal and Close Modal
                    $('.btnModalEditUser').on("click", function () {
                        event.preventDefault();
                        $.ajax({
                            url: $(this).attr('href'),
                            type: 'GET',
                            data: null
                        }).done(function (r) {
                            $('[name="id_user"]').val(r.data.id);
                            $('[name="name"]').val(r.data.name);
                            $('[name="email"]').val(r.data.email);
                            $('[name="id_type_user"]').val(r.data.id_type_user);
                            $('#chkActiveUser').prop('disabled', false);
                            $('#chkInactiveUser').prop('disabled', false);
                            if (r.data.state == 'A') {
                                $('#chkActiveUser').attr('checked', true);
                                $('#chkActiveUser').prop('checked', true);
                            } else {
                                $('#chkInactiveUser').attr('checked', true);
                                $('#chkInactiveUser').prop('checked', true);
                            }
                            $('#formCreateUpdateUser').attr('action', rootURL + 'cms/update-user/' + r.data.id);
                            $('#headerCreateUpdateUser').text('Edit User');
                            $('#contentStatusUser').prop('hidden', false);
                            $('#btnSubmitCreateUpdateUser').text('Update');
                            return $('#modalCreateUpdateUser').modal({backdrop: 'static'});
                        });
                    });
                    $('#btnCloseModalCreateUpdateUser').on('click', function () {
                        event.preventDefault();
                        $('#formCreateUpdateUser').attr('action', rootURL + 'cms/store-user');
                        $('#headerCreateUpdateUser').text('Create User');
                        $('#contentStatusUser').prop('hidden', true);
                        $('#chkActiveUser').prop('disabled', true);
                        $('#chkInactiveUser').prop('disabled', true);
                        $('[name="state"]').removeAttr('checked');
                        $('#formCreateUpdateUser')[0].reset();
                        $('#btnSubmitCreateUpdateUser').text('Create');
                        return $('#modalCreateUpdateUser').modal('hide');
                    });
                }


            },
            fnDeletePosts: function () {
                event.preventDefault();
                if (confirm("Esta seguro(a) de eliminar el o los elemento(s) seleccionado(s)?")) {
                    $.ajax({
                        headers: csrf_token,
                        url: rootURL + 'cms/post/change-state',
                        type: 'PUT',
                        data: {ids: ids, state: 'I'}
                    }).done(function (r) {
                        if (r.load) {
                            window.location.reload();
                        } else {
                            window.location.reload();
                        }
                    });
                } else {
                    event.preventDefault();
                }
            },
            fnCheckedAll: function () {
                ids = [];// inicializamos el valor del array temporal
                var $this = $(this),
                    $table = $this.closest('table'),
                    $arrayChecks = $table.find('.chkOnly');
                if ($this.is(':checked')) {
                    $arrayChecks.prop('checked', true);// aplicar checked a todos los seleccionados
                    validate = true;// condicion para actualizar masivamente
                    $('#btnDelete').removeClass('hidden').prop('disabled', false);// no mostrar las acciones de mantenimiento
                    $.each($arrayChecks, function (k, v) {
                        ids.push($(v).closest('tr').data('id'));
                    });
                } else {
                    $arrayChecks.prop('checked', false);
                    validate = false;
                    $('#btnDelete').addClass('hidden').prop('disabled', true);// mostrar las acciones de mantenimiento
                }
            },
            fnChecked: function () {
                var $this = $(this);
                if ($this.is(':checked')) {
                    $this.prop('checked', true);
                    $('#btnDelete').removeClass('hidden').prop('disabled', false);// no mostrar las acciones de mantenimiento
                    validate = true;
                    ids.push($this.closest('tr').data('id'));// agregamos el item IDm haciendo checked unitario
                } else {
                    $this.prop('checked', false);
                    $.each(ids, function (k, v) {
                        if (v == $this.closest('tr').data('id')) {
                            ids.splice(k, 1);// eliminar en el arreglo la posicion mandada y reordenar el arreglo
                        }
                    });
                    if (ids.length == 0) {// si solo queda un item en el array temporal
                        $('#btnDelete').addClass('hidden').prop('disabled', true);// mostrar las acciones de mantenimiento
                        validate = false;// falseamos a que no sera una actualizacion masiva
                        ids = [];// inicializamos el array de datos temporales
                        $('#chkAll').prop('checked', false);// le quitamos el checked al check-masivo
                    }
                }
            },
            fnCleanSpace: function ($inputString, $outputElement) {
                var concatenado = '';
                for (var i = 0; i < $inputString.length; i++) {//for
                    concatenado += ($inputString.charAt(i) == ' ') ? '-' : $inputString.charAt(i);
                }//fin del for
                return $outputElement.val(concatenado);
            }
        };

        Ctrl.start();

    }

    return Ctrl;

});

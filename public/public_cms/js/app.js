/**
 * Created by aquispe on 14/08/2017.
 */

define([
    'jquery'
], function ($) {

    var Ctrl, ids = [], validate = false;

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

                // Checked Edition
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
            }

            // If Exist Modal for Tables
            if ($('#modalCreateUpdateTable').length) {

                // Button Edit Modal
                $('.btnModalEditTable').on("click", function () {
                    event.preventDefault();
                    $.ajax({
                        url: $(this).attr('href'),
                        type: 'GET',
                        data: null
                    }).done(function (r) {

                        if (r.data.roles != undefined) {
                            var array_roles = JSON.parse(r.data.roles);
                            $.each(array_roles, function (k, v) {
                                if (v == "on") {
                                    $('#' + k).attr('checked', true);
                                    $('#' + k).prop('checked', true);
                                } else {
                                    $('#' + k).attr('checked', false);
                                    $('#' + k).prop('checked', false);
                                }
                            });
                        }

                        $('[name="id_field_table"]').prop('disabled', false);
                        $('[name="id_table"]').prop('disabled', false);
                        $('#chkActiveTable').prop('disabled', false);
                        $('#chkInactiveTable').prop('disabled', false);
                        $('[name="table"]').prop('disabled', true);

                        $('[name="id_table"]').val($('[name="table"]').val());
                        $('[name="id_field_table"]').val(r.data.id);
                        $('[name="name"]').val(r.data.name);
                        $('[name="alias"]').val(r.data.alias);

                        if (r.data.status == 'A') {
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
                    }).fail(function (r) {
                        console.error(r);
                    });
                });

                // Button Close Modal
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
                    $('[name="status"]').removeAttr('checked');
                    $('[name="id_field_table"]').val('');
                    $('[name="id_table"]').val('');

                    $('#formCreateUpdateTable')
                        .find("input[type=checkbox], input[type=radio]").removeAttr("checked").prop("checked", false)
                        .end();
                    $('#formCreateUpdateTable')[0].reset();

                    $('#btnSubmitCreateUpdateTable').text('Create');
                    $('#modalCreateUpdateTable').modal('hide');
                });

                // Checked Create
                var chkbxs = [], $inputCheckbox = $('.role_checked');
                if (!$inputCheckbox.is(':checked')) {
                    $inputCheckbox.each(function (k, v) {
                        chkbxs.push({id: $(v).data('id'), name: $(v).val(), value: false});
                        $('[name="roles"]').val(JSON.stringify(chkbxs));
                    });
                }

                // Checked Edition
                $inputCheckbox.on('click', function () {
                    var $this = $(this);
                    // chkbxs2 = $.parseJSON($('[name="roles"]').val());
                    if ($this.is(':checked')) {
                        $this.attr('checked', true);
                        $this.prop('checked', true);
                    } else {
                        $this.attr('checked', false);
                        $this.prop('checked', false);
                    }
                    // $('[name="roles"]').val(JSON.stringify(chkbxs2));
                });

                // Checked All Roles
                $('#role_post').on('click', function () {
                    var $this = $(this),
                        $tr = $(this).closest('tr'),
                        $checkbox = $tr.find('.role_checked');

                    if ($this.is(':checked')) {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', true);
                            $(v).prop('checked', true);
                        });
                        $this.attr('checked', true);
                        $this.prop('checked', true);
                    } else {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', false);
                            $(v).prop('checked', false);
                        });
                        $this.attr('checked', false);
                        $this.prop('checked', false);
                    }

                    // return false;
                    // chkbxs2 = $.parseJSON($('[name="roles"]').val());
                    // if ($this.is(':checked')) {
                    //     $this.attr('checked', true);
                    //     $this.prop('checked', true);
                    // } else {
                    //     $this.attr('checked', false);
                    //     $this.prop('checked', false);
                    // }
                    // $('[name="roles"]').val(JSON.stringify(chkbxs2));
                });
                $('#role_user').on('click', function () {
                    var $this = $(this),
                        $tr = $(this).closest('tr'),
                        $checkbox = $tr.find('.role_checked');

                    if ($this.is(':checked')) {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', true);
                            $(v).prop('checked', true);
                        });
                        $this.attr('checked', true);
                        $this.prop('checked', true);
                    } else {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', false);
                            $(v).prop('checked', false);
                        });
                        $this.attr('checked', false);
                        $this.prop('checked', false);
                    }

                    // return false;
                    // chkbxs2 = $.parseJSON($('[name="roles"]').val());
                    // if ($this.is(':checked')) {
                    //     $this.attr('checked', true);
                    //     $this.prop('checked', true);
                    // } else {
                    //     $this.attr('checked', false);
                    //     $this.prop('checked', false);
                    // }
                    // $('[name="roles"]').val(JSON.stringify(chkbxs2));
                });
                $('#role_portfolio').on('click', function () {
                    var $this = $(this),
                        $tr = $(this).closest('tr'),
                        $checkbox = $tr.find('.role_checked');

                    if ($this.is(':checked')) {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', true);
                            $(v).prop('checked', true);
                        });
                        $this.attr('checked', true);
                        $this.prop('checked', true);
                    } else {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', false);
                            $(v).prop('checked', false);
                        });
                        $this.attr('checked', false);
                        $this.prop('checked', false);
                    }

                    // return false;
                    // chkbxs2 = $.parseJSON($('[name="roles"]').val());
                    // if ($this.is(':checked')) {
                    //     $this.attr('checked', true);
                    //     $this.prop('checked', true);
                    // } else {
                    //     $this.attr('checked', false);
                    //     $this.prop('checked', false);
                    // }
                    // $('[name="roles"]').val(JSON.stringify(chkbxs2));
                });
                $('#role_tables').on('click', function () {
                    var $this = $(this),
                        $tr = $(this).closest('tr'),
                        $checkbox = $tr.find('.role_checked');

                    if ($this.is(':checked')) {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', true);
                            $(v).prop('checked', true);
                        });
                        $this.attr('checked', true);
                        $this.prop('checked', true);
                    } else {
                        $checkbox.each(function (k, v) {
                            $(v).attr('checked', false);
                            $(v).prop('checked', false);
                        });
                        $this.attr('checked', false);
                        $this.prop('checked', false);
                    }
                });
            }

            // If Exist Team Register
            if ($('#view-team-register').length) {
                var navListItems = $('ul.setup-panel li a'),
                    allWells = $('.setup-content');

                allWells.hide();

                navListItems.click(function () {
                    var $target = $($(this).attr('href')),
                        $item = $(this).closest('li');
                    if (!$item.hasClass('disabled')) {
                        navListItems.closest('li').removeClass('active');
                        $item.addClass('active');
                        allWells.hide();
                        $target.show();
                    }
                });

                $('ul.setup-panel li.active a').trigger('click');

                $('#activate-step-2').on('click', function () {
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='file'],input[type='password'],input[type='number'],input[type='email'],textarea,select"),
                        isValid = true;

                    for (var i = 0; i < curInputs.length; i++) {
                        if (!curInputs[i].validity.valid) {
                            isValid = false;
                        }
                    }

                    if (isValid) {
                        $('ul.setup-panel li:eq(1)').removeClass('disabled');
                        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
                    } else {
                        nextStepWizard.removeAttr('disabled').trigger('click');
                    }

                });

                $('#activate-step-3').on('click', function () {
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='file'],input[type='password'],input[type='number'],input[type='email'],textarea,select"),
                        isValid = true;

                    for (var i = 0; i < curInputs.length; i++) {
                        if (!curInputs[i].validity.valid) {
                            isValid = false;
                        }
                    }

                    if (isValid) {
                        $('ul.setup-panel li:eq(2)').removeClass('disabled');
                        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
                    } else {
                        nextStepWizard.removeAttr('disabled').trigger('click');
                    }

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
                    data: {ids: ids, status: 'I'}
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
            for (var i = 0; i < $inputString.length; i++) {
                concatenado += ($inputString.charAt(i) == ' ') ? '-' : $inputString.charAt(i);
            }
            return $outputElement.val(concatenado);
        }
    };

    Ctrl.start();

    return Ctrl;

});

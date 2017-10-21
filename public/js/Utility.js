/**
 * Created by QuispeRoque on 27/04/17.
 */
define([
    'jquery',
    'underscore',
    'moment',
    'bootpag',
    'autocomplete',
    'bootstrap-datetimepicker'
], function ($, _,momentjs) {
    var Utility = {
        totalItems: 0,
        idPaginador: $('#pagination-here'),
        limite: 2,
        pagina: 1,
        nextPage: 0,
        maxVisible: 0,
        intervalID: 0,
        intervalTitle: 0,
        intervalModalError: 0,
        formatDate: 'YYYY-MM-DD',
        data: [],
        obj: {},
        moment:momentjs,
        start: function () {
            this.moment.locale('es');
            $.fn.datetimepicker.defaults.defaultDate = this.moment().format('DD-MM-YYYY');
            $.fn.datetimepicker.defaults.format = 'YYYY-MM-DD';
            $.fn.datetimepicker.defaults.allowInputToggle = true;
            $.fn.datetimepicker.defaults.locale = 'es';
            $.fn.datetimepicker.defaults.icons = {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-dot-circle-o',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            };
        },
        fnCloseAndResetModal: function ($form) {
            $form.closest('.modal').modal('hide');
        },
        fnCloseModal: function ($modal) {
            $modal.modal('hide');
        },
        fnAlert: function ($pageTag, message, alertType) {
            alertType = alertType || 'alert-success';
            $pageTag.find('div.content-message').html(_.template($('#message-alert').html(), {variable: 'message'})(message))
                .children().addClass(alertType);
        },
        fnAlertBootstrap: function (txtTitle, txtMessage, txtLevel, alert) {
            var $alert = $('#AlertNotificationsAJAX'), fa = 'fa-check';
            if (alert != undefined) {
                $alert = $(alert);
            }
            switch (txtLevel) {
                case "danger":
                    txtLevel = "danger";
                    fa = 'fa-remove';
                    break;
                case "warning":
                    txtLevel = "warning";
                    fa = 'fa-warning';
                    break;
                case "info":
                    txtLevel = "info";
                    fa = 'fa-info';
                    break;
                default:
                    txtLevel = "success";
            }
            $alert.prop("hidden", false);
            $alert.addClass("alert-" + txtLevel);
            $alert.find('#pTittle i').addClass(fa);
            $alert.find('#pTittle b').text(txtTitle);
            $alert.find('#pDetail').html(txtMessage);
            if (txtLevel == 'danger' || txtLevel == 'warning') {
                setTimeout(function () {
                    $alert.prop("hidden", true);
                }, 15000);
            } else {
                setTimeout(function () {
                    $alert.prop("hidden", true);
                }, 5000);
            }
        },
        fnDoCicloObjects: function (arrObjects, template) {
            var i = 0, html = "";
            for (i; i < arrObjects.length; i++) {
                html += template(arrObjects[i]);
            }
            return html;
        },
        fnTwoDecimals: function (monto) {
            return parseFloat(monto).toFixed(2);
        },
        fnGetDomOptionFromSelect: function ($fieldSelect, val) {
            var fieldSelect = $fieldSelect[0], returnOption = '';

            if (fieldSelect.tagName === 'SELECT') {
                $fieldSelect.children().each(function (id, el) {
                    if (el.value === val) {
                        returnOption = el;
                        return false;
                    }
                });
            } else {
                throw 'Not a select field';
            }
            return returnOption;
        },
        fnResetAddSelectedSelect: function ($select, value) {
            value = value || $select.val();
            $select.children().attr('selected', false);
            if (!value) {
                $select.val(value).children().first().attr('selected', true);
            } else {
                $select.val(value).children().filter('[value=' + value + ']').attr('selected', true);
            }
        },
        fnGetTextFromSelect: function (obj) {
            return $(obj.selectedOptions).text().trim();
        },
        fnGetSuggestion: function (suggestion) {
            var $this = $(this);
            Util.fnAddCustomEventToAuto($this, suggestion, null, true);
        },
        fnGetSuggestionForRoute: function (suggestion) {
            var $this = $(this);
            Util.fnAddCustomEventToAuto($this, suggestion, $this.data('page'), false, true);
        },
        fnLookAutoComplete: function (elem, data, fnc) {
            var Util = this,
                $elem = $(elem),
                page = $elem.data('page');

            if (elem === '#emp_rubro') {
                fnc = function (suggestion) {
                    if (suggestion.value.length) {
                        $elem.data('rubro', suggestion.value);
                    }
                };
            }

            fnc = fnc || (page ? this.fnGetSuggestionForRoute : this.fnGetSuggestion);
            $elem.autocomplete({
                lookup: data,
                appendTo: Util.appendTo,
                lookupLimit: 12,
                autoSelectFirst: true,
                minChars: 3,
                width: elem == '#txtSearchEnterprice' ? 500 : 360,
                tabDisabled: true,
                onSelect: fnc
            });
        },
        fnGetDaysInMonth: function (month, anio) {
            return new Date(anio || new Date().getFullYear(), month, 0).getDate();
        },
        fnModalAlert: function ($message) {
            var $modal = $('#modal-alert');
            $modal.modal('show').find('.modal-body p').html($message);
        },
        fnShowErrorLaravel: function ($form, toastr, errorRpta, errorStatus, errorThrown) {
            var errorsGlobal = errorRpta.responseJSON;
            var errorsToDisplay = [];
            // Unprocessable Entity - Sent in case of validation error
            // 7. add an error class to the problematic fields
            // and display a notification toast with a description of the error(s)

            if (errorRpta.status === 422) {
                $form.find('.has-error').removeClass('has-error');
                $.each(errorsGlobal, function (key, value) {
                    $form.find('label[for=' + key + ']').parents('.form-group').addClass('has-error');
                    errorsToDisplay.push(value[0] || value);
                });
                return toastr.error(errorsToDisplay.join('<br />'), 'Validation Errors', {timeOut: 4000});

            } else if (errorRpta.status === 412) {
                $form.find('.has-error').removeClass('has-error');
                $.each(errorsGlobal, function (key, value) {
                    $form.find('label[for=' + key + ']').parents('.form-group').addClass('has-error');
                    errorsToDisplay.push(value.info);
                });
                return toastr.error(errorsToDisplay.join('<br />'), 'Validation Errors', {timeOut: 4000});

            } else {
                return toastr.error('Code: ' + errorRpta.status, 'Error', {timeOut: 4000});
            }
        },
        fnRemoveHiddenClass: function ($obj) {
            if ($obj.hasClass('hidden')) {
                $obj.removeClass('hidden');
            }
            return $obj;
        },
        fnAddHiddenClass: function ($obj) {
            if (!$obj.hasClass('hidden')) {
                $obj.addClass('hidden');
            }
            return $obj;
        },
        fnEnableAllControls: function (options) {
            if (options.inputs) {
                options.inputs.prop('disabled', false);
                return;
            }

            if (options.form) {
                $(options.form + ' :input').prop('disabled', false);
            }
        },
        fnCallbackFail: function (mc, resp, options) {
            resp = resp == 'error' ? mc : resp;
            if (resp.responseJSON) {
                if (resp.responseJSON.redirect) {
                    alert(resp.responseJSON.error_message);
                    location.href = resp.responseJSON.redirect;
                } else if (resp.responseJSON.type === 4) {
                    Util.fnModalAlert(resp.responseJSON.error_message);
                } else if (resp.responseJSON.fields_error) {
                    var error_message = '<ul>';
                    for (var i = 0; i < resp.responseJSON.fields_error.length; i++) {
                        error_message += '<li>' + resp.responseJSON.fields_error[i] + '</li>';
                    }
                    error_message += '</ul>';
                    Util.fnModalAlert(error_message);
                } else {
                    alert(resp.responseJSON.error_message);
                }
            } else {
                alert('Sucedió un error inesperado, contacte con sistemas.');
            }
            Utility.fnEnableAllControls(options);
            Utility.fnRemoveLoadingNow();
        },
        fnGetObjectFields: function (fields, other) {
            var data = {}, otherField = [];
            _.each(fields, function (val) {
                if (parseInt(val.value) && !isNaN(val.value) && val.name != 'fac_dni' && val.name != 'dni' && val.name != 'empresa_ruc') {
                    data[val.name] = parseFloat(val.value);
                } else if (val.name !== 'id') {
                    data[val.name] = val.value;
                }
                if (val.name === other) {
                    otherField.push(val.value);
                }
            });

            if (otherField.length) {
                data[other] = otherField;
            }
            return data;
        },
        fnDisabledButton: function ($btn) {
            if (!$btn.is(':disabled')) {
                $btn.prop('disabled', true);
            }
            return $btn;
        },
        fnEnableButton: function ($btn) {
            if ($btn.is(':disabled')) {
                $btn.prop('disabled', false);
            }
            return $btn;
        },
        fnloadingTable: function (colspan, txt) {
            var template = _.template($('#loadingTable').html()), html = '';
            html = template({colspan: colspan, txt: txt});
            return html;
        },
        fnLoading: function ($element,txt) {
            var template = _.template($element.html()), html = '';
            html = template({txt: txt});
            return html;
        },
        fnfailedTable: function (colspan) {
            var template = _.template($('#failedTable').html()), html;
            html = template({colspan: colspan});
            return html;
        },
        fnBootpag: function ($idPagination, $idDetailPagination, data) {
            $idPagination.bootpag({
                total: Math.ceil(Utility.totalItems / Utility.limite),
                page: data.pagina,
                maxVisible: Utility.maxVisible,
                leaps: false,
                firstLastUse: false,
                first: '&laquo;',
                last: '&raquo;',
                next: '&raquo;',
                prev: '&laquo;',
                wrapClass: 'pager',
                activeClass: 'active',
                disabledClass: 'disabled',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first'
            });
            // this.fnBootpagDetail($idDetailPagination, data);
        },
        fnBootpagDetail: function ($idDetailPagination, data) {
            var templatePaginationDetail = _.template($('#detailPagination').html()),//template html
                htmlPD = templatePaginationDetail({
                    inicial: 1 + ((data.pagina - 1) * Utility.limite),
                    final: data.data.length + ((data.pagina - 1) * Utility.limite),
                    totales: Utility.totalItems
                });
            $idDetailPagination.html(htmlPD);//contenido html
        },
        fnAutocomplete: function (response, element, second, $function) {
            $(element).autocomplete({
                lookup: response,
                tabDisabled: true,
                triggerSelectOnValidInput: true,
                onSelect: function (suggestion) {
                    $(element).prop('disabled', true);
                    $.extend(Utility.obj, suggestion.data);

                    if(second != undefined){
                        $(second).closest('div').removeClass('not-visible');
                    }
                    if($function != undefined){
                        $function();
                    }

                }
            });
        },
        fnOpenShowModal: function (modal, options) {
            if (options == undefined) {
                options = {backdrop: 'static', keyboard: false};
            }
            $(modal).modal(options);
            $(modal).show();
        },
        fnCatch:function(r){
            if(r.status === 401){
                r=r.responseJSON;
               return alert(r.error);
                // return this.fnAlertBootstrap("ERROR",r.error,"danger");
            }else{
                if (!r.load) {
                    console.warn(r.detail);
                    // Utility.fnAlertBootstrap(r.title, r.detail, r.level);
                }
            }
        },
        fnAnimate:function ($element) {
            $element.css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1}, "slow");
        }
    };
    Utility.start();
    return Utility;
});
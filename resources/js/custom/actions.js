import moment from "moment";

window.$ = window.jQuery = require('jquery');
import Swal from "sweetalert2";

window.$ = window.jQuery = require('jquery');
let toastr = require('toastr/toastr');
require('./bootstrap-tagsinput');
require('simplebar');
toastr.options = {
    timeOut: 1000,
    extendedTimeOut: 100,
    tapToDismiss: true,
    debug: false,
    fadeOut: 10,
    positionClass: "toast-top-center"
};
window.toastr = toastr;

window.topbar = require('../topbar');
require('./Jadoon')
const select2 = require('select2')


$.fn.inputFilter = function (callback, errMsg) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function (e) {
        if (callback(this.value)) {
            // Accepted value
            if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                $(this).removeClass("input-error");
                this.setCustomValidity("");
            }
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
            // Rejected value - restore the previous one
            $(this).addClass("input-error");
            this.setCustomValidity(errMsg);
            this.reportValidity();
            this.value = this.oldValue;
            try {
                // this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } catch (e) {

            }

        } else {
            // Rejected value - nothing to restore
            this.value = "";
        }
    });
};


let parser_url = url => url.slice(url.indexOf('?') + 1)
    .split('&')
    .reduce((a, c) => {
        let [key, value] = c.split('=');
        a[key] = value;
        return a;
    }, {});
$(document).ready(function () {
    $.ajaxPrefilter(function (options, _, jqXHR) {
        if (options.url && options.url.includes('user/get-areass')){
            // console.log(options.url,options);
            if (options.data){
                // console.log(decodeURI(options.data),"ff")
                $('.select_all_checkbox').prop('checked',false)
                    .trigger('change');
                /*const url= parser_url(options.data);*/
            }
        }
        jqXHR.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
        /*console.log(options,jqXHR)*/
        // $.ajaxSetup({headers: {'X-CSRF-TOKENß': $('meta[name="csrf-token"]').attr('content')}});
        showLoader();
        jqXHR.done(function (dd) {
            /*  $('.mws-html-dropdown').html('');*/
            /*console.log('done',dd)*/
            hideLoader()
        }).catch(function () {
            hideLoader();
        });
    });
});

window.validateAlphabet = () => {
    if ($('.input_string').length > 0) {
        $('.input_string').inputFilter(function (value) {
            return /^[a-z ]+$/i.test(value);
        }, "" /*"Must be an integer"*/);
    }
}

window.inputFieldNumber = () => {
    if ($('.input_number').length > 0) {
        $('.input_number').attr('type', 'number')
        $(".input_number").inputFilter(function (value) {
            return (/^\d*$/.test(value))/*&& (value === "" || parseInt(value) <= 500); */
        }, "" /*"Must be an integer"*/);
    }
    //window.validateAlphabet();
}

window.inputFieldNumberMax = () => {
    if ($('.input_number_max_number').length > 0) {
        const input_number_max_number = $('.input_number_max_number');
        const max_number = Number(input_number_max_number.attr('max'));
        const message = input_number_max_number.attr('message');
        $(".input_number_max_number").inputFilter(function (value) {
            value = Number(value);
            return /^\d*$/.test(value) && (value <= max_number);
        }, message);
    }
}

Number.prototype.formater = function () {
    //return x.toLocaleString('en-US');
    return new Intl
        .NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        })
        .format(
            this.toFixed(2)
        ).replace("$", '')
        ;
}

const product_types_grids = [];
window.dynamicSelection = (elem) => {
    const url = elem.attr('url')
    const target = elem.attr('target')
    const params = (elem.attr('params')).split(',')
    const placeholder = elem.attr('placeholder')
    const triggerSelect = elem.attr('triggerSelect')
    const isGroup = elem.attr('is_group')
    const prefix = elem.attr('prefix')
    const hasSubReload = elem.attr('hasSubReload')
    const active_option = (elem.attr('active_option') !== undefined) ? elem.attr('active_option') : ''
    let form_data = {};
    let firstValue = '';
    for (let i = 0; i < params.length; i++) {
        let columnValue = $(`.input_${params[i]}`).val();
        firstValue = columnValue;
        if (columnValue !== '' && columnValue !== null) {
            if (prefix !== undefined) {
                form_data[(params[i]).replace(prefix, '')] = columnValue;
            } else {
                form_data[params[i]] = columnValue;
            }
        }
        if (isGroup !== undefined) {
            form_data['is_group'] = 1
        }
        if ((params.length - 1) - i === 0) {
            $.ajax({
                url: url,
                type: 'get',
                data: form_data,
                beforeSend: function () {
                    showLoader()
                },
                success: function (rows) {
                    if (target !== undefined) {
                        $(target).html('');
                        let optionPlaceholder = ``;
                        if (elem.attr('targetMultiple') == 1) {
                            if ($('select[name="role_id"]').length > 0) {
                                let roleId = ''
                                if ($('select[name="role_id"]').val() == 5) {
                                    roleId = 6;
                                }
                                if ($('select[name="role_id"]').val() == 6) {
                                    roleId = 5;
                                }
                                if (roleId) {
                                    optionPlaceholder = $(`select[name="role_id"] option[value="${roleId}"]`).text();
                                }
                            }
                        }
                        $(target).append((placeholder !== undefined) ? `<option value="">${placeholder} ${optionPlaceholder}</option>` : '')
                    }
                    if (rows !== undefined && rows.length > 0 && isGroup === undefined) {
                        rows.map((row, index) => {
                            const {id, name} = row
                            if (target !== undefined && id !== undefined && name !== undefined) {
                                $(target).append(`<option ${(active_option !== '' && Number(active_option) === Number(id)) ? 'selected' : ''} value="${id}">${name}</option>`)
                            }

                            /*if ((rows.length -1) ===index){
                                if ($(".am_id_selector").length>0){
                                    if ($('select[name="role_id"]').val() ==6){
                                        if ($(".am_id_selector").hasClass("select2-hidden-accessible")) {
                                            $(".am_id_selector").select2("destroy");
                                        }
                                        $(document).find('.am_id_selector').select2({
                                            multiple:true,
                                            dropdownParent: $('#default_modal'),
                                        });
                                    }
                                    if ($('select[name="role_id"]').val() ==5){
                                        if ($(".am_id_selector").hasClass("select2-hidden-accessible")) {
                                            $(".am_id_selector").select2("destroy");
                                        }
                                        $(document).find('.am_id_selector').select2({
                                            multiple:false,
                                            dropdownParent: $('#default_modal'),
                                        });
                                    }

                                }
                            }*/
                        })
                    } else if (rows !== undefined && rows.length > 0 && isGroup !== undefined) {
                        let optionsGroup = `<option value="">${placeholder}</option>`;
                        rows.map((row, index) => {
                            const {options} = row
                            let childOptions = '';
                            options.map((o_row, i) => {
                                const {id, name} = o_row
                                childOptions += `<option ${(active_option !== '' && Number(active_option) === Number(id)) ? 'selected' : ''} value="${id}">${name}</option>`;
                            })
                            optionsGroup += `<optgroup label="${row.name}">${childOptions}</optgroup>`;
                        })
                        if (target !== undefined) {
                            $(target).html(optionsGroup);
                        }

                    } else {
                        if (target !== undefined) {
                            $(target).html('')
                        }
                    }
                    if (rows !== undefined && rows.length === 0) {
                        $(target).prop('disabled', true)
                        $($(target).attr('hassubreload')).html('').prop('disabled', true)
                    } else {
                        $(target).prop('disabled', false)
                    }
                    hideLoader()
                    if (hasSubReload !== undefined) {
                        $(hasSubReload).trigger('change');
                    }
                    if (triggerSelect !== undefined) {
                        $(`${triggerSelect} option:selected`).removeAttr('selected');
                        $(`${triggerSelect} option[task_type_id="${firstValue}"]`).attr('selected', 'selected');
                        $(`${triggerSelect}`).trigger('change');
                    }
                },
                error: function (error) {
                    showError(error)
                }
            });
        }
    }
}

jQuery.fn.mwsNumeric =
    function () {
        return this.each(function () {
            $(this).keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;

                // console.log(key);
                // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                // home, end, period, and numpad decimal
                return (
                    key == 8 ||
                    key == 9 ||
                    key == 13 ||
                    key == 46 ||
                    key == 110 ||
                    key == 190 ||
                    (key >= 35 && key <= 40) ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
            });
        });
    };

$(document).ready(function () {



    if ($('.filter-mws').length==0){
        $('.mws-filter').hide()
    }
    // $('body').on('change','input[type="file"]',function (e){
    //     const elem  =   $(this);
    //     const file = elem.prop('files')[0];
    //     if ((file.type).includes('video')){
    //         toastr.warning('File format is invalid!')
    //         elem.val('')
    //         return;
    //     }
    // });

    if ($('.ccrm-select').length > 0) {
        $('.ccrm-select').select2();
    }
    window.inputFieldNumber();

    function removeError(elem) {
        const name = elem.attr('name');
        if (elem.attr('prefix') !== undefined) {
            if ($(".error_" + elem.attr('name').replace(/\[\d+\]/g, '') + elem.attr('prefix')).length > 0) {
                $(".error_" + elem.attr('name').replace(/\[\d+\]/g, '') + elem.attr('prefix')).remove();
            }
        } else {
            if ($(".error_".concat(name)).length > 0) {
                $(".error_".concat(name)).remove();
            }
        }
    }

    $('body').on('focus', 'input,textarea', function (e) {
        const elem = $(this);
        removeError(elem)
    });
    $('body').on('change', 'select', function (e) {
        const elem = $(this);
        removeError(elem)
    })

    $('.sidebar-scroll .navbar-nav').height((window.innerHeight - 130))


    /*if ($('.calculate-area').length > 0) {
        $('.calculate-area').mwsNumeric();
    }*/


    if ($('.form-select-multiple').length > 0) {
        $('.form-select-multiple').select2();
    }
    const product_search_filter = (product_types_grids, value) => {
        let index = -1;
        for (let i = 0; i < product_types_grids.length; i++) {
            if (product_types_grids[i].product_id === value) {
                index = i;
            }
        }
        return index
    }


    if ($('.mws_tags').length > 0) {
        $('.mws_tags').tagsinput();
    }


    $('body').on('change', '.changeInputMws', function () {
        const elem = $(this);
        if ($(elem).attr('name') === 'role_id') {


            const targetSelect = $(elem).attr('target');
            // console.log($(elem).val() == 5);
            if ($(elem).val() == 5 && $(elem).attr('name') == 'role_id') { /* account manager*/
                $($(targetSelect).attr('target')).removeAttr('multiple')
                if ($('select[name="am_id"]').length > 0) {
                    $('select[name="am_id"]').html('').prop('disabled', true)
                }
            }
            if ($(elem).val() == 6 && $(elem).attr('name') == 'role_id') { /* telesales roles code added*/
                $($(targetSelect).attr('target')).attr('multiple', 'multiple')
                if ($('select[name="am_id"]').length > 0) {
                    $('select[name="am_id"]').html('').prop('disabled', true)
                }
            }

            if ($(targetSelect).attr('targetMultiple')) {
                if ($(elem).val() == 5) { /* account manager*/
                    $($(targetSelect).attr('target')).removeAttr('multiple')
                    if ($('select[name="am_id"]').length > 0) {
                        //  $('select[name="am_id"]').html('')
                    }
                }
                if ($(elem).val() == 6) { /* telesales roles code added*/
                    $($(targetSelect).attr('target')).attr('multiple', 'multiple')
                }
            }
            if ($(elem).val() == 5) {
                if ($(".am_id_selector").hasClass("select2-hidden-accessible")) {
                    // Select2 has been initialized
                    $(".am_id_selector").select2("destroy");
                }
                $(document).find('.am_id_selector').select2(
                    {
                        multiple: false,
                        dropdownParent: $('#default_modal'),
                    });
            }
            if ($(elem).val() == 6) {
                if ($(".am_id_selector").hasClass("select2-hidden-accessible")) {
                    // Select2 has been initialized
                    $(".am_id_selector").select2("destroy");
                }
                $(document).find('.am_id_selector').select2(
                    {
                        multiple: true,
                        dropdownParent: $('#default_modal'),
                    });
            }
        }


        dynamicSelection(elem);

    });
    $('body').on('click', '.permission-click', function () {
        const elem = $(this);
        const parentCard = elem.parents('.card');
        if (parentCard.find('div.collapse').hasClass('show')) {
            //    alert('open')
        } else {
            //  alert('close')
        }

    });
    const roles = ['admin', 'sales', 'employee'];
    roles.map((role, i) => {
        $(`#${role}accordion`).on('shown.bs.collapse', function (e) {
            const group = $(e.target).attr('group');
            $(`button.permission-click[group="${group}"]`).find('i.mws-icon').removeClass('la-plus').addClass('la-minus')
        })
        $(`#${role}accordion`).on('hidden.bs.collapse', function (e) {
            const group = $(e.target).attr('group');
            $(`button.permission-click[group="${group}"]`).find('i.mws-icon').removeClass('la-minus').addClass('la-plus')
        })

    })
    /* $('#myCollapsible').on('shown.bs.collapse', function () {
         // do something…
     })
 */
    $('body').on('change', '.form-checkbox-mws', function () {
        const elem = $(this);

        const roleId = elem.attr('role_id');
        const permission = elem.val();

        const data = [{
            roleId,
            permission,
            isChecked: elem.is(':checked') ? 1 : 0,
            _token: elem.attr('token')
        }];
        $.ajax({
            url: elem.attr('url'),
            type: 'post',
            data: {permissions: data},
            beforeSend: function () {
                showLoader()
            },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.message)
                }
                window.inputFieldNumber();
                hideLoader()
            },
            error: function (error) {
                hideLoader()
                showError(error)
            }
        })
        // console.log(data);
    })

    $('body').on('change', '.filter_by_member', function () {
        const elem = $(this);
        const url = elem.attr('url');
        if (elem.val() !== '') {
            window.location.href = `${url}?member=${elem.val()}`
        } else {
            window.location.href = `${url}`
        }
    });
    $('body').on('click', '.modal', function (e) {
        const elem = $(e.target);
        if (elem.hasClass('modal')) {
            $('#default_modal').modal('show');
        }
    });


    $('body').on('click', '.modal_open', function (e) {
        e.preventDefault();
        const elem = $(this);
        const url = elem.attr('url')
        const modalSize = elem.attr('size')
        const data = elem.attr('data') !== undefined ? elem.attr('data') : {};
        openModalUrl(url, modalSize, 'get', data);

    })
    $('body').on('click', '.modal_submit', function (e) {
        e.preventDefault();
        const elem = $(this);
        const url = elem.attr('url')
        const method = elem.attr('method')
        const modalSize = elem.attr('size')
        const swal_text = elem.attr('swal_text');
        const swal_icon = elem.attr('swal_icon');
        const swal_icon_color = elem.attr('swal_icon_color') !== undefined ? elem.attr('swal_icon_color') : '3085d6';
        const cancelButtonText = elem.attr('cancel_button_text') !== undefined ? elem.attr('cancel_button_text') : 'No';
        const swal_title = elem.attr('swal_title');
        const swal_button = elem.attr('swal_button');
        const data = (elem.attr('data') !== undefined && elem.attr('data') !== '' && elem.attr('data') !== null) ? JSON.parse(elem.attr('data')) : {}
        if (swal_title !== undefined && swal_text !== undefined && swal_button !== undefined) {
            Swal.fire({
                title: swal_title,
                text: swal_text,
                icon: swal_icon,
                showCancelButton: true,
                confirmButtonColor: '#' + swal_icon_color,
                cancelButtonColor: '#d33',
                confirmButtonText: swal_button,
                cancelButtonText: cancelButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    post_url(url, data, (method !== undefined) ? method : 'post');
                }
            })
        } else {
            post_url(url, data, (method !== undefined) ? method : 'post');
        }

    })
    $('body').on('click', '.swal_open', function (e) {
        e.preventDefault();
        const elem = $(this);
        const swal_text = elem.attr('swal_text');
        const url = elem.attr('url');
        const swal_icon = elem.attr('swal_icon');
        const swal_icon_color = elem.attr('swal_icon_color') !== undefined ? elem.attr('swal_icon_color') : '3085d6';
        const cancelButtonText = elem.attr('cancel_button_text') !== undefined ? elem.attr('cancel_button_text') : 'No';
        const swal_title = elem.attr('swal_title');
        const swal_button = elem.attr('swal_button');
        if (swal_title !== undefined && swal_text !== undefined && swal_button !== undefined && url !== undefined) {
            Swal.fire({
                title: swal_title,
                text: swal_text,
                icon: swal_icon,
                showCancelButton: true,
                confirmButtonColor: '#' + swal_icon_color,
                cancelButtonColor: '#d33',
                confirmButtonText: swal_button,
                cancelButtonText: cancelButtonText
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        } else {
            alert('Sorry unable to perform action');
        }
    });

    function post_url(url, data, method = 'post') {
        $.ajax({
            url: url,
            type: method,
            data: data,
            beforeSend: function () {
                showLoader()
            },
            success: function (html) {
                const {
                    success,
                    message,
                    title,
                    close_modal,
                    table,
                    isOpenNewModal,
                    modalUrl,
                    modalSize,
                    modalMethod,
                    sweetalert,
                    clear_data,
                    data_key,
                    reload
                } = html


                if (clear_data !==undefined){
                    $(clear_data).removeAttr(data_key)
                    $(clear_data).prop('disabled',true)
                    $('.select_all_checkbox').prop('checked',false)
                }
                if (success) {
                    if (close_modal) {
                        if ($('#default_modal').hasClass('show')) {
                            $('#default_modal').modal('hide');
                        }
                    }
                    if (table) {
                        window.LaravelDataTables[table].draw();
                    }
                    if (isOpenNewModal) {
                        if ($('#default_modal').hasClass('show')) {
                            $('#default_modal').modal('hide');
                        }
                        openModalUrl(modalUrl, modalSize, modalMethod, {})
                    }
                    if(reload){
                        window.location.href = html.redirect;
                    }
                }
                if (!success) {
                    if (sweetalert) {
                        Swal.fire({
                            title: title,
                            text: message,
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {

                        })
                        return;
                    }
                }
                if (typeof success !== "undefined" && success === false && message) {
                    toastr.error(message);
                } else {
                    if (message) {
                        toastr.success(message);
                    }
                }
                window.inputFieldNumber();
            },
            error: function (error) {
                // console.log(error)
                showError(error)
                hideLoader()
            }
        });
    }

    function loadAjaxUrl(url, modalSize, params = {}) {
        $.ajax({
            url: url,
            type: 'get',
            data: params,
            beforeSend: function () {
                showLoader()
            },
            success: function (html) {
                $('#default_modal').html(html);
                $('#default_modal .modal-dialog').removeClass('modal-xl')
                $('#default_modal .modal-dialog').removeClass('modal-lg')
                $('#default_modal .modal-dialog').removeClass('modal-sm')
                $('#default_modal .modal-dialog').addClass(`modal-${modalSize}`)
                $('#default_modal').modal('show');
                window.inputFieldNumber();
                hideLoader()
            },
            error: function (error) {
                showError(error)
                hideLoader()
            }
        });
    }

    $('body').on('click', '.form_submit', function (e) {
        e.preventDefault();
        var that = $(this)

        const elem = $(this);

        let buttonText = elem.html();
        const form = elem.parents('form');

        const formData = new FormData(form[0]);
        if (elem.attr('name') !== undefined) {
            formData.append(elem.attr('name'), elem.val());
        }
        let values = [];
        $.each($('input:not(:disabled), select:not(:disabled) ,textarea:not(:disabled)', form[0]), function (index, row) {
            row = $(row);
            if (row.attr('name') !== undefined) {
                let name = (row.attr('name')).replace('[]', '')
                //console.log(row.attr('t_multiple'),row)
                if (row.is('input')) {
                    if (row.attr('type') === 'file') {
                        if (row[0].files > 0) {
                            formData.append(name, row[0].files[0])
                        }
                    }
                    /* else if (row.attr('t_multiple') ==1) {
                         console.log(row,$(`.input-${name}`).length,'ROW muliple')
                         $(`.input-${name}`).each(function (ii,el){
                             console.log($(el).val(),'ROddW muliple')
                             if($(el).is(':checked')){
                                 values.push($(el).val())
                             }
                         })
                         console.log(values,'VALUES')
                         formData.append(name, values.join(','))
                     } else if (row.attr('t_multiple_2') ==2) {
                         console.log(row,$(`.input-${name}`).length,'ROW muliple')
                         $(`.input-${name}`).each(function (ii,el){
                             console.log($(el).val(),'ROddW muliple')
                             if($(el).is(':checked')){
                                 values.push($(el).val())
                             }
                         })
                         console.log(values,'VALUES')
                         formData.append(name, values.join(','))
                     }*/
                    else if (row.attr('type') === 'radio') {
                        if (row.is(':checked')) {
                            formData.append(name, row.val())
                        }
                    } else if (row.attr('type') === 'checkbox') {
                        if (row.is(':checked')) {
                            formData.append(name, row.val())
                        }
                    } else {
                        formData.append(name, row.val())
                    }
                } else if (row.is('select')) {
                    let value = row.val();
                    formData.append(name, (value !== undefined) ? value : '')
                } else if (row.is('textarea')) {
                    formData.append(name, row.val())
                }
                if (!row.hasClass(`input-${name}`)) {
                    if (row.attr('prefix') !== undefined) {
                        // console.log('name',name);
                        row.addClass(`input-${name.replace(/\[\d+\]/g, '')}` + row.attr('prefix'))
                    } else {
                        row.addClass(`input-${name}`)
                    }
                }
            }
        });

        $(`.has-error`).remove();
        if (form.attr('action') !== undefined) {
            $.ajax({
                url: form.attr('action'),
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                type: 'POST',
                beforeSend: function () {
                    //TODO:here
                    showLoader();
                    elem/*.html('Please wait ...')*/.prop('disabled', true)
                },
                success: function (response) {
                    let {
                        success, message, redirect, close_modal, html, table, is_ajax_url,
                        ajaxUrl, modalSize, tag, row, tag_scroll
                    } = response;
                    if (success === true) {
                        if (redirect !== undefined && redirect !== '') {
                            window.history.pushState({}, '', redirect);
                            elem/*.html('Please wait ...')*/.prop('disabled', true)
                            setTimeout(() => {
                                window.location.href = `${redirect}`
                            }, 1000)
                        }

                        if (is_ajax_url !== undefined) {
                            loadAjaxUrl(ajaxUrl, modalSize, {});
                        }
                        if ($('#default_modal').length > 0 && close_modal) {
                            if ($('#default_modal').hasClass('show')) {
                                $('#default_modal').modal('hide');
                            }
                            try {
                                window.LaravelDataTables[table].draw();
                            } catch (e) {

                            }
                        }
                        if (!close_modal) {
                            try {
                                window.LaravelDataTables[table].draw();
                            } catch (e) {

                            }
                        }
                        if ($('#default_modal').length > 0 && close_modal) {
                            if ($('#default_modal').hasClass('show')) {
                                $('#default_modal').modal('hide');
                            }
                            elem/*.html(buttonText)*/.prop('disabled', false)
                        }

                        if (tag !== undefined && html !== undefined) {
                            $(tag).html(html);
                        }
                        /* if (tag !== undefined && row !== undefined) {
                             try {
                                 const html_data = `<div class="d-flex mb-1"><div class="flex-shrink-0"><img src="${(row.user_image instanceof Object) ? row.user_image.encoded : row.user_image}" alt="" class="avatar-xs rounded-circle"/></div><div class="flex-grow-1 ms-3"><h5 class="fs-14">${row.user_name}<small class="text-muted ms-2">${row.comment_time}</small></h5><p class="text-muted">${row.message}</p></div></div>`
                                 $(tag).append(html_data);
                                 $(tag_scroll).animate({
                                     scrollTop: $(tag).height()
                                 }, 1000);
                             } catch (e) {
                             }
                         }*/

                        if (that.hasClass('submit_reset')) {
                            that.parents('form').trigger('reset');
                            that.parents('form').find('.hidden-cheque, .hidden-payorder, .hidden_adjusted_unit_id').addClass('d-none');
                        }
                        // console.log(message, 'Message Text')
                        toastr.success(message);

                    } else {
                        toastr.error(message);
                        elem/*.html(buttonText)*/.prop('disabled', false)
                    }
                    window.mwsIndex = 1; /* resetting aa*/


                    hideLoader();

                    // do something with the result
                },
                error: function (error) {
                    // console.log(error)
                    elem/*.html(buttonText)*/.prop('disabled', false)
                    showError(error)
                }
            });
        }
    });

    window.TotalCalculatedCost = (package_amount) => {
        let total = 0;
        let addon_price = 0;
        if (package_amount < 1) { // on add remove and change addone quantity
            $(document).find('.item_price').each(function () {
                let item_price = parseInt($(this).text());
                addon_price = addon_price + item_price;
                total = total + item_price;

                // Removed Selected Addon From DropDown
                let selectedAdonId = $(this).attr('id');
                let is_strip = $(this).attr('is_strip');
                setTimeout(function () {
                    let select2Dropdown = $('.input_addon_id');
                    select2Dropdown.select2('destroy');
                    if (is_strip == 'no') {
                        select2Dropdown.find('option[value="' + selectedAdonId + '"]').remove();
                    }
                    select2Dropdown.val('');
                    select2Dropdown.select2();
                }, 500);
            });

            $(document).find('#TotalCost').val(addon_price);
        } else { // on change package amount
            // var package_amount = $('body').find('.input_package_id').find("option:selected").attr('price');
            $(document).find('#package_amount').val(parseInt(package_amount));
        }


        let package_total = $(document).find('#package_amount').val();
        let addons_total = $(document).find('#TotalCost').val();
        let totals = parseInt(package_total) + parseInt(addons_total);

        // console.log('package_total',package_total);
        // console.log('addons_total',addons_total);
        // console.log('totals',totals);

        $(document).find('#payment_amount').val(totals);

        if (!$(document).find('#is_partial_payment').is(':checked')) {
            $(document).find('#amount_paid').val(totals);
        }
        const Totalin_words = convertAmountToWords(totals);
        $(document).find('#payment_amount').next('.in_words').text(Totalin_words);

        // const Pa_In_words = convertAmountToWords(parseInt(package_total));
        // $(document).find('#package_amount').next('.in_words').text(Pa_In_words);

        // setTimeout(function(){
        //     // $(document).find('.MonthByNo').select2();
        //     // $(document).find('.agency_areas').select2();
        // },800);


        // if($('body').find('#is_partial_payment').is(':checked')){
        //     var installments = $('body').find('#no_of_installments option:selected').val();
        //     installment_amount(installments);
        // }
    }
    $('body').on('change', '.ajax_load_select', function (e) {
        const elem = $(this);
        const url = elem.attr('url');
        const method = elem.attr('method');
        const targetDiv = elem.attr('target_div');
        const isAppend = elem.attr('append') !== undefined ? Number(elem.attr('append')) : 0;

        const params = (elem.attr('params')).split(',')

        const totalItems = $('.department_list .item-row').length;
        const data = {};
        for (let i = 0; i < params.length; i++) {
            var columnValue = $(`.input_${params[i]}`).val();
            if (columnValue !== '' && columnValue !== null) {
                data[params[i]] = columnValue;
            }
        }
        data.item_added = totalItems;
        $.ajax({
            url: url,
            type: method,
            data: data,
            beforeSend: function () {
                showLoader()
            },
            success: function (html) {
                if (isAppend === 1) {
                    $(`.${targetDiv}`).append(html);
                } else {
                    $(`.${targetDiv}`).html('');
                    $(`.${targetDiv}`).html(html);
                }
                if (html.warning) {
                    toastr.warning(html.message);
                } else {
                    toastr.success('loaded');
                }
                hideLoader()
                window.resizeWindow();
            },
            error: function (error) {
                showError(error)
            }
        });
    });
    $('body').on('click', '.ajax_load', function (e) {
        e.preventDefault();
        // console.log('load')
        const elem = $(this);
        const url = elem.attr('url');
        const method = elem.attr('method');
        const targetDiv = elem.attr('target_div');

        const params = (elem.attr('params')).split(',')

        const data = {};
        for (let i = 0; i < params.length; i++) {
            let columnValue = $(`[name="${params[i]}"]`).val();
            if (columnValue !== '' && columnValue !== null) {
                data[params[i]] = columnValue;
            }
        }
        // console.log(data);
        $.ajax({
            url: url,
            type: method,
            data: data,
            beforeSend: function () {
                showLoader()
            },
            success: function (html) {
                $(`.${targetDiv}`).html(html);
                toastr.success('loaded');
                hideLoader()
            },
            error: function (error) {
                showError(error)
            }
        });
    });

    $('body').on('click', '.close', function (e) {
        if ($('#default_modal').hasClass('show')) {
            $('#default_modal').modal('hide');
        }
        /* if($('.filter-dropdown').length>0){
             $('.filter-dropdown').select2('destroy');
             $('.filter-dropdown').select2();
         }*/
        window.mwsIndex = 1;

        // console.log(mwsIndex, 'close')
    });

});

window.mwsIndex = 1;

$(document).ready(function () {

    /*window.showTopBar(2000);*/


    // console.log('hi')

    let dropdownItem = undefined;
    let dropDownHtml = undefined;
    $('body').on('show.bs.dropdown', '.mws-dropdown', function (e) {
        //e.preventDefault()
        const elem = $(this);
        dropdownItem = elem
        dropDownHtml = elem.find('.dropdown-menu').html();
        elem.parents('body').find('.mws-html-dropdown').append(elem.find('.dropdown-menu').css({
            position: 'absolute',
            left: $('.mws-dropdown').offset().left,
            top: $('.mws-dropdown').offset().top
        }).detach());
    });

    $('body').on('hidden.bs.dropdown', '.mws-dropdown', function (e) {
        e.preventDefault()
        const elem = $(this);
        if (dropdownItem) {
            elem.find('.dropdown-menu').css({
                position: 'relative', left: 0, top: 0
            }).detach();
            dropDownHtml = undefined
            dropdownItem = undefined
        }
    });

    $('body').on('click', '.deleteItem', function () {
        const elem = $(this);
        const mswsIndex = elem.attr('mwsindex');
        $(`.phone-number-group[mwsindex="${mswsIndex}"]`).remove()

        $('.listItem').each(function (i, row) {
            row = $(row);
            let newIndex = i + 1;
            row.attr('mwsindex', newIndex)
            row.find('label').html(`Phone ${newIndex}`)
            row.find('input').attr('name', `phone${newIndex}`)
            row.find('input').attr('placeholder', `Phone ${newIndex}`)
            row.find('button[type="button"]').attr('mwsindex', `${newIndex}`)
        })
        window.mwsIndex = ($('.listItem').length) + 1
        updatePhoneButton($('.addPhoneNumber'), window.mwsIndex)


    });


    $('body').on('click', '.addPhoneNumber', function () {
        const elem = $(this);
        // console.log(window.mwsIndex, 'sss add phone')
        let html = `<div class="col-md-6 listItem phone-number-group phone_result"  mwsindex="${window.mwsIndex}" >
                        <label for="email" class="form-label">Phone ${window.mwsIndex}</label>
                        <div class="input-group form-label">
                            <input name="phone${window.mwsIndex}" type="number" class="form-control  input_number" placeholder="Phone ${window.mwsIndex}"/>
                            <div class="input-group-append">
                                <button mwsindex="${window.mwsIndex}" class="btn btn-danger deleteItem" type="button"><i class="fa fa-trash"></i></button>
                            </div>

                        </div>
 <p class="result"></p>
                    </div>`;
        if (window.mwsIndex < 6) {
            $('.mwsBefore').append(html);
            window.mwsIndex++;
        }
        updatePhoneButton(elem, window.mwsIndex)
    })


    $('body').on('input', '.isMobileValid', function () {
        const phoneNumberValue = $(this).val();
        if ($('.has-phone-error').length > 0) {
            $('.has-phone-error').remove();
        }
        const regex = /^03\d{3}\d{6}$/;
        const isValid = regex.test(phoneNumberValue);
        var content;
        if (isValid) {
            $('.has-phone-error').remove();
        } else {
            content = '<p class="has-phone-error text-danger">Phone number is Not Valid</p>';
        }
        if ($(this).parents('div.input-group').hasClass('input-group')) {
            $(this).parents('div.input-group').after(content);
        } else {
            $(this).after(content);
        }

    });


    /* /!* YouTube links JS*!/*/

    $(document).on('click', '.make-super-hot', function () {

    })
    window.updateLinkButton = (elem, mwsIndex) => {
        const data_max = Number(elem.attr('data_max') !== undefined ? elem.attr('data_max') : 6);
        if (mwsIndex === data_max) {
            elem.prop('disabled', true)
        } else {
            elem.prop('disabled', false)
        }
    }

    $('body').on('click', '.deleteLink', function () {
        const elem = $(this);
        const mswsIndex = elem.attr('mwsindex');
        $(`.youtube-link-group[mwsindex="${mswsIndex}"]`).remove()

        $('.listItem').each(function (i, row) {
            row = $(row);
            let newIndex = i + 1;
            row.attr('mwsindex', newIndex)
            row.find('label').html(`Link ${newIndex}`)
            row.find('input').attr('name', `link[${newIndex}]`)
            row.find('input').attr('placeholder', `Link ${newIndex}`)
            row.find('button[type="button"]').attr('mwsindex', `${newIndex}`)
        })
        var ll = $(document).find('.mwslinks').find('.listItem').length;
        // console.log('ll', ll);
        window.mwsIndex = ($('.listItem').length) + 1
        updateLinkButton($('.addYoutubeLink'), window.mwsIndex)
    });

    $(document).on('click', '.addYoutubeLink', function () {
        const elem = $(this);
        const data_max = Number(elem.attr('data_max') !== undefined ? elem.attr('data_max') : 6);
        window.mwsIndex = $(document).find('.mwslinks').find('.listItem').length + 1;
        let html = `<div class="col-md-8 listItem youtube-link-group link_result "  mwsindex="${window.mwsIndex}" >
                        <label for="email" class="form-label">Link ${window.mwsIndex}</label>
                        <div class="input-group form-label">
                            <input name="link[${window.mwsIndex}]" type="text" class="form-control  " placeholder="Link ${window.mwsIndex}"/>
                            <div class="input-group-append">
                                <button mwsindex="${window.mwsIndex}" class="btn btn-danger deleteLink" type="button"><i class="fa fa-trash"></i></button>
                            </div>

                        </div>
                        <p class="link-youtube"></p>
                    </div>`;
        if (window.mwsIndex < data_max) {
            $(document).find('.mwslinks').append(html);
            window.mwsIndex++;
        }
        updateLinkButton(elem, window.mwsIndex)
    })
    /*/!**!/End YouTube links**/
});

$(document).ready(function () {
    setTimeout(() => {
        resizeWindow();
    }, 10);

    $(window).resize(function () {
        resizeWindow();
    });
});
window.resizeWindow = (p = 0) => {
    $('body').css({
        overflow: 'hidden'
    });
    $('html').css({
        overflow: 'hidden'
    });
    $('.mws-main-body').css({
        'max-height': ScrollFixed(30),
        'overflow-y': 'scroll'
    })

    if ($('.mws-main-body .table').length === 0) {

    } else {
       /* $('.dataTables_wrapper table tbody').css({
            'max-height': ScrollFixed(180 - p)
        })*/
    }


    /* const table  = $('.filterBtn') .parents('.form-group.filter-button').attr('table');
     if (table){
         $(table).dataTable().fnSettings().scrollY = '100px';
         $(table).dataTable().fnAdjustColumnSizing();
     }*/

}

// JavaScript to set equal column widths

window.resizeColumn = () => {
    const tableHeader = $('.table thead th');
    $('.table tbody tr').map((i,tr)=>{
        $(tr).find('td').map((tdi,td)=>{
            const thWidth = $(tableHeader[tdi]).outerWidth()-3;
            $(td).css({
                'width':thWidth+'px'
            });
        });
    })
}

window.ScrollFixed = (p) => {
    // console.log(p, 'pp')
    const headerHeight = $('.navbar.navbar-dark.sticky-top').outerHeight() ?? 0;
    const tableTheadHeight = $('.table thead').outerHeight() ?? 0;
    const filterHeight = $('.mws-main-header').outerHeight() ?? 0;
    const tHeight = $(document).outerHeight() ?? 0;
    let totalHeight = 0;
    if ($('.mws-main-body .table').length === 0) {
        totalHeight = headerHeight + tableTheadHeight + filterHeight;
    } else {
        totalHeight = headerHeight + tableTheadHeight + filterHeight - 100;
    }

    // console.log(totalHeight, tHeight)
    return `calc(100vh - ${totalHeight + p}px)`;
}
window.showTopBar = (seconds = undefined) => {
    window.topbar.config({
        autoRun: true,
        barThickness: 5,
        barColors: {
            '0': '#37394F',
            '.3': '#37394F',
            '1.0': '#37394F'
        },
        //shadowBlur   : 5,
        //shadowColor  : 'rgba(0, 0, 0, .5)',
        className: 'topbar',
    })
    if (seconds) {
        window.topbar.show(seconds);
    } else {
        window.topbar.show();
    }

}

window.showLoader = () => {
    /*$('.loader').show()*/


    window.showTopBar(undefined);
    /*Swal.fire({
        title: 'Loading',
        html: 'Please wait ....',
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
        },
        willClose: () => {
        }
    })*/
}
window.hideLoader = () => {
    /* $('.loader').hide()*/

    window.topbar.hide();

    /* Swal.close()
     try {
         var table = $('#overall_revenue_reports_financials').DataTable();
         // var api = table.api();
         console.log('yes' + table.ajax.json().recordsTotal)

         console.log('No' + table.ajax.json().total_counts)
         // Output the data for the visible rows to the browser's console
         // console.log( api.rows( {page:'current'} ).data() );
     } catch (e) {

     }*/
}


function showError(error) {
    const {status, responseJSON} = error;

    if (status === 422) {
        const {message, errors} = responseJSON;
        $.each(errors, function (elem, value) {
            const html = `<div class="text-danger has-error error_${elem.replace('.', '_')}">${value}</div>`
            if ($(`.input-${elem.replace('.', '_')}`).is('select') && $(`.input-${elem.replace('.', '_')}`).hasClass('select2-hidden-accessible')) {
                $(`.input-${elem.replace('.', '_')}`).next('span.select2-container').after(html);
            } else {
                if ($(`.input-${elem.replace(/\./g, '_')}`).attr('type') == 'radio') {
                    $(`.input-${elem.replace(/\./g, '_')}`).parents('.radio-row').after(html);
                } else {
                    $(`.input-${elem.replace(/\./g, '_')}`).after(html);
                }
            }
        })
        toastr.warning(message);
    } else if (status === 500) {
        const {message} = responseJSON;
        toastr.error(message);
    } else if (status === 403) {
        const {message} = responseJSON;
        toastr.warning(message !== '' ? message : 'You are not allow to perform  that action');
    } else if (status === 401) {
        const {message} = responseJSON;
        toastr.warning(message !== '' ? message : 'Login required!');
    }

    hideLoader()
}


require('./Filter')


$(document).ready(function () {
    $('body').on('click', '.sidebar .nav-item.has-submenu .nav-link', function () {

        const elem = $(this);
        const submenu = elem.parents('.has-submenu');
        if (submenu.hasClass('show')) {
            submenu.removeClass('show')
        } else {
            submenu.addClass('show')
        }

    })
});

window.openModalUrl = (url, modalSize, modalMethod = 'get', data = {}) => {
    $.ajax({
        url: url,
        type: 'get',
        data: (Object.keys(data)).length != 0 ? JSON.parse(data) : {},
        beforeSend: function () {
            showLoader()
        },
        success: function (html) {

            // console.log(isJsonString(html))
            if (isJsonString(html)) {
                window.sweetAlertCrm(html.title, html.message, 'Ok', false);
                hideLoader()
                return;
            } else {
                $('#default_modal').html(html);
                $('#default_modal .modal-dialog').removeClass('modal-xl')
                $('#default_modal .modal-dialog').removeClass('modal-lg')
                $('#default_modal .modal-dialog').removeClass('modal-sm')
                $('#default_modal .modal-dialog').addClass(`modal-${modalSize}`)
                $('#default_modal').modal('show');

                if ($('.ccrm-select').length > 0) {
                    $('.ccrm-select').select2();
                }


                if ($('.ccrm-selectnew').length > 0) {
                    $('.ccrm-selectnew').select2({
                        templateSelection: function (data, container) {

                            if ($(data.element).hasClass('no-clear-button')) {
                                if ($(container[0]).length > 0) {
                                    $(container[0]).addClass('disabled_selected')
                                }
                                //console.log(data,container,$(container).attr('title'),title)
                                /* setTimeout(()=>{
                                     const title = container.attr('title')
                                     container.attr('title',`You have already assign agency in that area ${title}`)
                                     container.css({
                                         cursor:'pointer'
                                     });
                                     container.tooltip()
                                     $(data.element).attr('selected','selected');
                                 },100)*/
                                container.addClass('button-disabled')
                                return $('<span>').text(data.text);
                            }
                            return data.text;
                        }
                    });
                    $('.ccrm-selectnew').on("select2:unselecting", function (e) {
                        if ($(e.params.args.data.element).hasClass('no-clear-button')) {
                            e.preventDefault();
                            return false
                        }
                    });
                }

                if ($('.addPhoneNumber').length > 0) {
                    window.updatePhoneButton($('.addPhoneNumber'), window.mwsIndex)
                }

                window.inputFieldNumber();
                setTimeout(() => {
                    //   window.inputFieldNumber()
                }, 1000)
            }
            hideLoader()


        },
        error: function (error) {
            // console.log(error)
            showError(error)
            hideLoader()
        }
    });
}
window.updateStartEndDate = () => {
    const contractMonth = $('#Contract').val();
    const startDate = $('input[name="start_date"]').val() ? $('input[name="start_date"]').val() : moment().format('YYYY-MM-DD');
    $('input[name="end_date"]').val(moment(startDate, 'YYYY-MM-DD').add(contractMonth, 'months').format('YYYY-MM-DD'))
    $('input[name="start_date"]').val(startDate);
}
/*document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

        element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;
            let parentEl  = element.parentElement;

            if(nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);

                if(nextEl.classList.contains('show')){
                    mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if(opened_submenu){
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); // addEventListener
    }) // forEach
});*/

window.updateDatableScroller = () => {
    let dataTables_scrollBody = $('.dataTables_scrollBody');
    const headerNavbar = $('header.navbar');
    const cardHeader = $('main .card .card-header');
    const searchPanel = $('.SearchFilterPanel');

    const minusValue = headerNavbar.height() + cardHeader.height() + searchPanel.height()

    // console.log(minusValue, window.innerHeight);
    dataTables_scrollBody.css({
        height: (window.innerHeight - minusValue)
    });
}
$(document).on('change', 'input[type=number]', function (e) {
    e.preventDefault();
    if ($(this).val() < 0) {
        $(this).val(0);
    }
});
window.updatePhoneButton = (elem, mwsIndex) => {
    if (mwsIndex === 5) {
        elem.prop('disabled', true)
    } else {
        elem.prop('disabled', false)
    }
}


// $(document).ready(function (){
// setTimeout(()=>{
//     window.updateDatableScroller();
// },2000)
// });

window.convertAmountToWords = (amount) => {
    const singleDigits = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
    const teens = ["ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
    const tens = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
    const scale = ["", "thousand", "million", "billion", "trillion"];

    const convertThreeDigits = (num) => {
        let result = "";
        if (num >= 100) {
            result += singleDigits[Math.floor(num / 100)] + " hundred ";
            num %= 100;
        }
        if (num >= 10 && num <= 19) {
            result += teens[num - 10] + " ";
            num = 0;
        } else if (num >= 20) {
            result += tens[Math.floor(num / 10)] + " ";
            num %= 10;
        }
        if (num > 0) {
            result += singleDigits[num] + " ";
        }
        return result;
    };

    if (amount === 0) {
        return "Zero";
    }

    let words = "";
    let i = 0;
    while (amount > 0) {
        if (amount % 1000 !== 0) {
            words = convertThreeDigits(amount % 1000) + scale[i] + " " + words;
        }
        amount = Math.floor(amount / 1000);
        i++;
    }

    return words.trim().charAt(0).toUpperCase() + words.slice(1);
}

$(document).ready(function () {
    $('body').on('click', '.button_approve', function () {
        const elem = $(this);
        $('.popup-detail').hide();
        $('.comment_popups').show();
        $('.btn_approved_button').show();
        $('.btn_rejected_button').hide();
        $('.popup-buttons').hide();
        elem.parents('.modal-content').find('.modal-title').html('Approve Contract')

    });
    $('body').on('click', '.button_reject', function () {
        const elem = $(this);
        $('.popup-detail').hide();
        $('.comment_popups').show();
        $('.popup-buttons').hide();
        $('.btn_approved_button').hide();
        $('.btn_rejected_button').show();
        elem.parents('.modal-content').find('.modal-title').html('Reject Contract')
    });


    $('body').on('input', '.contract_remark_input', function () {
        const elem = $(this);

        const comment = elem.val();
        const data = {comment: comment};
        $('.btn_approved_button').attr('data', JSON.stringify(data));
        $('.btn_rejected_button').attr('data', JSON.stringify(data));

        if (comment.length > 0) {
            $('.btn_approved_button').prop('disabled', false)
            $('.btn_rejected_button').prop('disabled', false)
        } else {
            $('.btn_approved_button').prop('disabled', true)
            $('.btn_rejected_button').prop('disabled', true)
        }

    });


})

window.sweetAlertCrm = (title, text, confirmButton = 'Yes', cancelButton = 'Cancel', showCancelButton = false) => {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: showCancelButton,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButton,
        cancelButtonText: cancelButton
    })
}
// Example usage:
// const amount = 123456789;
// const words = convertAmountToWords(amount);
// console.log(words);

// Agency SEarch

$(document).ready(function () {

    var path = $(document).find('.agencySearchSelect2').attr('url');

    $(document).find('.agencySearchSelect2').select2({

        placeholder: 'Search Agency', // usesd in filters
        ajax: {
            url: path,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    var PropertyPath = $(document).find('.propertyIdSearchSelect2').attr('url');
    $(document).find('.propertyIdSearchSelect2').select2({
        placeholder: 'Search Property ID',
        ajax: {
            url: PropertyPath,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.propertyId,
                            id: item.propertyId
                        }
                    })
                };
            },
            cache: true
        }
    });
    var cityPath = $(document).find('.citysearchpath').attr('path');
    $(document).find('.citySearchSelect2').select2({
        placeholder: 'Search City',
        ajax: {
            url: cityPath,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
})

$(document).ready(function () {
    $('body').on('click', '.sideBarButton', function () {
        $('#sidebarMenu').parents('div.container-fluid').toggleClass('closeSidebar');
        $('.mws-sticky-sidebar li').removeClass('show')
        if (!$('#sidebarMenu').parents('div.container-fluid').hasClass('closeSidebar')) {
            $('#sidebarMenu').parents('div.container-fluid').addClass('openSidebar')
        } else {
            $('#sidebarMenu').parents('div.container-fluid').removeClass('openSidebar')
        }
        // $(this).addClass('openSidebar').removeClass('closeSidebar');
    });
});

window.isJsonString = (str) => {
    try {
        var json = JSON.parse(str);
        return (typeof json === 'object');
    } catch (e) {
        return (typeof str === 'object');
    }

}


 window.activateSteps = () =>{

    $('.setup-content').each(function () {
        var allFilled = true;
        // console.log('l1');
        $(this).find('input[required], select[required],textarea[required]').each(function () {
            // console.log('l2' , $(this).val());
            if ($(this).val() == '' || $(this).val() == 'null') {
               allFilled = false;
                // console.log('in if');
                return false;
            }
        });
        if(allFilled==true){
            // console.log(' allFilled true ');
            var stepId = $(this).attr('id');
            $(document).find('a[href="#' + stepId + '"]').addClass(' filled').find('i').removeClass('circle').addClass('bi-solid bi-check');
        }else{
            // console.log(' allFilled false ');
            var stepId = $(this).attr('id');
            $(document).find('a[href="#' + stepId + '"]').removeClass(' filled').find('i').addClass('circle').removeClass('bi-solid bi-check');

        }

    });

}
function nextandPrev(curStep, prevStepWizard){
    var curInputs = curStep.find("input[required='required'],input[type='radio'],input[type='checkbox'] , textarea[required='required']"),
        isValid = true;
    $(".form-group").removeClass("has-error");
    var select2Fields = curStep.find("select[required='required']");
    var isEmpty = false;
    select2Fields.each(function() {
        if ( $(this).val() =="null"){
            isEmpty = true;
            $(this).next('span').next('.text-danger').remove(); // Remove previous error message
            $(this).next('span').after(`<div class="text-danger">Please select an option.</div>`);
        }
    });
    if (isEmpty) {
        return;
    }
    for (var i = 0; i < curInputs.length; i++) {
        if (!curInputs[i].validity.valid) {
            isValid = false;
            if($(curInputs[i]).next('.text-danger').length==0){
                var fName = $(curInputs[i]).prev('label').text();
                $(curInputs[i]).after(`<div class="text-danger">The ${fName} field is required.</div>`);
            }
        }
    }
    if (isValid) prevStepWizard.removeAttr('disabled').trigger('click');
}
window.MultiStepFormJs = () => {
        activateSteps();
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPreBtn = $('.prevBtn');

        allWells.hide();
        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });
        allPreBtn.click(function () {
            activateSteps();
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
            nextandPrev(curStep , prevStepWizard);
        });
        allNextBtn.click(function () {
            activateSteps();
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");
            nextandPrev(curStep , nextStepWizard);
        });
        $('div.setup-panel div a.btn-success').trigger('click');

        $(document).find('.multiStep .form-control').on('input', function() {
            $(this).next('.text-danger').remove();
        });
        $(document).find('.multiStep .select2selector').on('change', function() {
            $(this).next('span').next('.text-danger').remove();
        });
    }






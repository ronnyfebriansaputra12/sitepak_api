<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8" />
		<title>MONITORING DWH</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<meta name="MobileOptimized" content="320">
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<?php $this->load->view('boot/styles');?>
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- END THEME STYLES -->

<script>
    var option_form = new Object();
    var dialog_confirm = new Object();
    var dialog_alert = new Object();
    jQuery.fn.select_readonly = function(option_readonly) {
        option_readonly = typeof option_readonly !== 'undefined' ? option_readonly : true;
        this.filter("select").each(function() {
            if (option_readonly) {
                $('option:not(:eq(' + this.selectedIndex + '))', $(this)).attr('disabled', true);
            } else {
                $('option', $(this)).attr('disabled', false);
            }
        });
        $(this).attr('readonly', false);
    };
    var char_tgl_server = '<?php echo date("d-m-Y")?>';
    /*untuk notifikasi*/

    jQuery(document).ready(function() {
        App.init('<?php echo base_url().VER_TEMPLATE;?>img/ajax-loading.gif');
        option_form = {
            errorLabelContainer: $('#form_validation_place'),
            wrapper: "li",
            invalidHandler: function(e, validator) {
                $('#form_validation_modal').modal('show');
                $('input.disabled,select.disabled', e.target).attr('disabled', true);
                App.updateUniform('input.disabled,select.disabled');
                $('input.disabled,select.disabled', e.target).removeClass('disabled');
                if ($(e.target).data('list')) {
                    $('#' + $(e.target).data('list')).unwrap();
                }
            },
            submitHandler: function(form) {
                $('.mask-nama').val(function(index, value) {
                    var string = value;
                    string = string.replace(/\s{2,}/g, ' ').trim();
                    string = string.replace(/'{2,}/g, "'");
                    return string;
                });
                $('.mask-alamat').val(function(index, value) {
                    var string = value;
                    string = string.replace(/\s{2,}/g, ' ').trim();
                    string = string.replace(/('|,|\u002E|\u002D|\u002F){2,}/g, '$1');
                    return string;
                });
                if ($(form).data('target')) {
                    if ($(form).data('konfirmasi')) {
                        dialog_confirm = bootbox.confirm({
                            title: 'PESAN',
                            className: "konfirmasi-simpan",
                            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-question-circle"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-info no-bullets"><label><li>' + $(form).data('konfirmasi') + '</li></label></ul></div>' + '</div>' + '</div>',
                            buttons: {
                                'confirm': {
                                    label: 'Ya',
                                    className: 'btn btn-success min-width margin-right btn-sm btn-focus'
                                },
                                'cancel': {
                                    label: 'Batal',
                                    className: 'btn btn-danger pull-right btn-sm'
                                },
                            },
                            callback: function(result) {
                                if (result) {
                                    $(form).ajaxSubmit({
                                        beforeSubmit: function() {
                                            App.blockUI({
                                                boxed: true,
                                                message: 'Harap Tunggu'
                                            });
                                            $('input[type="submit"],button[type="submit"]', form).attr('disabled', true);
                                        },
                                        success: function(responseText, statusText, xhr, form) {
                                            $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                            if (responseText.charAt(0) == '{') {
                                                var json = $.parseJSON(responseText);
                                                App.unblockUI();
                                                if (json.status == '1') {
                                                    dialog_alert = bootbox.alert({
                                                        title: 'PESAN',
                                                        className: "konfirmasi-simpan",
                                                        message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                                        buttons: {
                                                            'ok': {
                                                                label: 'Ya',
                                                                className: 'btn btn-success btn-sm btn-focus'
                                                            }
                                                        }
                                                    });
                                                    dialog_alert.find('.modal-body').addClass('alert-success');
                                                    dialog_alert.find('.modal-body').addClass('portlet-body');
                                                    $('input[type="submit"],button[type="submit"]', form).removeClass('green');
                                                    $('input[type="submit"],button[type="submit"]', form).addClass('default');
                                                    if (typeof json.javascript != 'undefined') {
                                                        eval(json.javascript);
                                                    }
                                                } else if (json.status == '2') {
                                                    dialog_alert = bootbox.alert({
                                                        title: 'PESAN',
                                                        className: "konfirmasi-simpan",
                                                        message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                                        buttons: {
                                                            'ok': {
                                                                label: 'Ya',
                                                                className: 'btn btn-success btn-sm btn-focus'
                                                            }
                                                        }
                                                    });
                                                    dialog_alert.find('.modal-body').addClass('alert-success');
                                                    dialog_alert.find('.modal-body').addClass('portlet-body');
                                                    $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                                    if (typeof json.javascript != 'undefined') {
                                                        eval(json.javascript);
                                                    }
                                                } else {
                                                    dialog_alert = bootbox.alert({
                                                        title: 'PESAN',
                                                        className: "konfirmasi-simpan",
                                                        message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                                        buttons: {
                                                            'ok': {
                                                                label: 'Tutup',
                                                                className: 'btn btn-danger btn-sm btn-focus'
                                                            }
                                                        }
                                                    });
                                                    dialog_alert.find('.modal-body').addClass('alert-danger');
                                                    dialog_alert.find('.modal-body').addClass('portlet-body');
                                                    $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                                    if (typeof json.javascript != 'undefined') {
                                                        eval(json.javascript);
                                                    }
                                                }
                                                $(dialog_alert).on('shown.bs.modal', function(e) {
                                                    dialog_alert.find('.btn-focus:last').focus();
                                                });
                                                if ($(form).data('list')) {
                                                    $('#' + $(form).data('list')).unwrap();
                                                }
                                            } else {
                                                $("#" + $(form).data('target')).html(responseText);
                                                $("#" + $(form).data('target')).show();
                                                if ($(form).data('hidden')) {
                                                    $("#" + $(form).data('hidden')).hide();
                                                }
                                                if ($(form).data('refresh')) {
			                                        $('#' + $(form).data('refresh')).submit();
			                                    }
                                                if ($(form).data('list')) {
                                                    $('#' + $(form).data('list')).unwrap();
                                                }
                                                App.initAjax();
                                                App.unblockUI();
                                            }
                                        }
                                    });
                                } else {
                                    $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                    $('input.disabled,select.disabled').attr('disabled', true);
                                    App.updateUniform('input.disabled,select.disabled');
                                    $('input.disabled,select.disabled').removeClass('disabled');
                                    /*if ($(form).data('refresh')) {
                                        $('#' + $(form).data('refresh')).submit();
                                    }*/
                                    if ($(form).data('list')) {
                                        $('#' + $(form).data('list')).unwrap();
                                    }
                                }
                            }
                        });
                        dialog_confirm.find('.modal-body').addClass('alert-info');
                        dialog_confirm.find('.modal-dialog').css('width', '34%');
                        $(dialog_confirm).on('shown.bs.modal', function(e) {
                            dialog_confirm.find('.btn-focus:last').focus();
                        });
                    } else {
                        optionAjax={};
                        if($(form).data('crossdomain')){
                            optionAjax={'crossDomain':true,xhrFields: {
                                    withCredentials: true
                            }};
                            console.log(optionAjax);
                        }
                        $(form).ajaxSubmit($.extend({
                            beforeSubmit: function() {
                                App.blockUI({
                                    boxed: true,
                                    message: 'Harap Tunggu'
                                });
                                $('input[type="submit"],button[type="submit"]', form).attr('disabled', true);
                            },
                            success: function(responseText, statusText, xhr, form) {
                                $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                if (responseText.charAt(0) == '{') {
                                    var json = $.parseJSON(responseText);
                                    App.unblockUI();
                                    if (json.status == '1') {
                                        dialog_alert = bootbox.alert({
                                            title: 'PESAN',
                                            className: "konfirmasi-simpan",
                                            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                            buttons: {
                                                'ok': {
                                                    label: 'Ya',
                                                    className: 'btn btn-success btn-sm btn-focus'
                                                }
                                            }
                                        });
                                        dialog_alert.find('.modal-body').addClass('alert-success');
                                        dialog_alert.find('.modal-body').addClass('portlet-body');
                                        $('input[type="submit"],button[type="submit"]', form).removeClass('green');
                                        $('input[type="submit"],button[type="submit"]', form).addClass('default');
                                        if (typeof json.javascript != 'undefined') {
                                            eval(json.javascript);
                                        }
                                    } else if (json.status == '2') {
                                        dialog_alert = bootbox.alert({
                                            title: 'PESAN',
                                            className: "konfirmasi-simpan",
                                            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                            buttons: {
                                                'ok': {
                                                    label: 'Ya',
                                                    className: 'btn btn-success btn-sm btn-focus'
                                                }
                                            }
                                        });
                                        dialog_alert.find('.modal-body').addClass('alert-success');
                                        dialog_alert.find('.modal-body').addClass('portlet-body');
                                        $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                        if (typeof json.javascript != 'undefined') {
                                            eval(json.javascript);
                                        }
                                    } else {
                                        dialog_alert = bootbox.alert({
                                            title: 'PESAN',
                                            className: "konfirmasi-simpan",
                                            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                            buttons: {
                                                'ok': {
                                                    label: 'Tutup',
                                                    className: 'btn btn-danger btn-sm btn-focus'
                                                }
                                            }
                                        });
                                        dialog_alert.find('.modal-body').addClass('alert-danger');
                                        dialog_alert.find('.modal-body').addClass('portlet-body');
                                        $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                        if (typeof json.javascript != 'undefined') {
                                            eval(json.javascript);
                                        }
                                    }
                                    $(dialog_alert).on('shown.bs.modal', function(e) {
                                        dialog_alert.find('.btn-focus:last').focus();
                                    });
                                    if ($(form).data('list')) {
                                        $('#' + $(form).data('list')).unwrap();
                                    }
                                } else {
                                    $("#" + $(form).data('target')).html(responseText);
                                    $("#" + $(form).data('target')).show();
                                    if ($(form).data('hidden')) {
                                        $("#" + $(form).data('hidden')).hide();
                                    }
                                    if ($(form).data('refresh')) {
                                        $('#' + $(form).data('refresh')).submit();
                                    }
                                    if ($(form).data('list')) {
                                        $('#' + $(form).data('list')).unwrap();
                                    }
                                    App.initAjax();
                                    App.unblockUI();
                                }
                            }
                        },optionAjax));
                    }
                } else {
                    $('input[type="submit"],button[type="submit"]', form).attr('disabled', true);
                    var form_valid = true;
                    if ($('input:disabled,select:disabled', form).length > 0 && !$(form).data('nondisable')) {
                        $('input:disabled,select:disabled', form).addClass('disabled');
                        $('input:disabled,select:disabled', form).attr('disabled', false);
                        var form_valid = $(form).valid();
                    }
                    if (form_valid) {
                        var konfirmasi = $(form).data('konfirmasi') ? $(form).data('konfirmasi') : 'Apakah data ingin simpan?';
                        dialog_confirm = bootbox.confirm({
                            title: 'PESAN',
                            className: "konfirmasi-simpan",
                            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-question-circle"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-info no-bullets"><label><li>' + konfirmasi + '</li></label></ul></div>' + '</div>' + '</div>',
                            buttons: {
                                'confirm': {
                                    label: 'Ya',
                                    className: 'btn btn-success min-width margin-right btn-sm btn-focus'
                                },
                                'cancel': {
                                    label: 'Batal',
                                    className: 'btn btn-danger pull-right btn-sm'
                                },
                            },
                            callback: function(result) {
                                if (result) {
                                    optionAjax={};
                                    if($(form).data('crossdomain')){
                                        optionAjax={'crossDomain':true,xhrFields: {
                                                withCredentials: true
                                        }};
                                        console.log(optionAjax);
                                    }
                                    $(form).ajaxSubmit($.extend({
                                        beforeSubmit: function() {
                                            App.blockUI({
                                                boxed: true,
                                                message: 'Harap Tunggu...'
                                            });
                                        },
                                        success: function(responseText, statusText, xhr, form) {
                                            var json = $.parseJSON(responseText);
                                            App.unblockUI();
                                            if (json.status == '1') {
                                                if(typeof json.pesan != 'undefined'){
                                                    dialog_alert = bootbox.alert({
                                                        title: 'PESAN',
                                                        className: "konfirmasi-simpan",
                                                        message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                                        buttons: {
                                                            'ok': {
                                                                label: 'Ya',
                                                                className: 'btn btn-success btn-sm btn-focus'
                                                            }
                                                        }
                                                    });
                                                    dialog_alert.find('.modal-body').addClass('alert-success');
                                                    dialog_alert.find('.modal-body').addClass('portlet-body');
                                                }
                                                $('input[type="submit"],button[type="submit"]', form).removeClass('green');
                                                $('input[type="submit"],button[type="submit"]', form).addClass('default');
                                                if (typeof json.data != 'undefined') {
                                                    for (key in json.data) {
                                                        if ($('#' + key).is('input') || $('#' + key).is('select')) {
                                                            $('#' + key).val(json.data[key]);
                                                        } else {
                                                            $('#' + key).text(json.data[key]);
                                                        }
                                                    }
                                                }
                                                if (typeof json.javascript != 'undefined') {
                                                    eval(json.javascript);
                                                }
                                            } else if (json.status == '2') {
                                                dialog_alert = bootbox.alert({
                                                    title: 'PESAN',
                                                    className: "konfirmasi-simpan",
                                                    message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                                    buttons: {
                                                        'ok': {
                                                            label: 'Ya',
                                                            className: 'btn btn-success btn-sm btn-focus'
                                                        }
                                                    }
                                                });
                                                dialog_alert.find('.modal-body').addClass('alert-success');
                                                dialog_alert.find('.modal-body').addClass('portlet-body');
                                                $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                                if (typeof json.javascript != 'undefined') {
                                                    eval(json.javascript);
                                                }
                                            } else {
                                                dialog_alert = bootbox.alert({
                                                    title: 'PESAN',
                                                    className: "konfirmasi-simpan",
                                                    message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                                    buttons: {
                                                        'ok': {
                                                            label: 'Tutup',
                                                            className: 'btn btn-danger btn-sm btn-focus'
                                                        }
                                                    }
                                                });
                                                dialog_alert.find('.modal-body').addClass('alert-danger');
                                                dialog_alert.find('.modal-body').addClass('portlet-body');
                                                $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                                if (typeof json.javascript != 'undefined') {
                                                    eval(json.javascript);
                                                }
                                            }
                                            $(dialog_alert).on('shown.bs.modal', function(e) {
                                                dialog_alert.find('.btn-focus:last').focus();
                                            });
                                            if ($(form).data('refresh')) {
                                                $('#' + $(form).data('refresh')).submit();
                                            }
                                            if ($(form).data('list')) {
                                                $('#' + $(form).data('list')).unwrap();
                                            }
                                        }
                                    },optionAjax));
                                } else {
                                    $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                                    $('input.disabled,select.disabled').attr('disabled', true);
                                    App.updateUniform('input.disabled,select.disabled');
                                    $('input.disabled,select.disabled').removeClass('disabled');
                                    if ($(form).data('list')) {
                                        $('#' + $(form).data('list')).unwrap();
                                    }
                                }
                            }
                        });
                        dialog_confirm.find('.modal-body').addClass('alert-info');
                        dialog_confirm.find('.modal-dialog').css('width', '34%');
                        $(dialog_confirm).on('shown.bs.modal', function(e) {
                            dialog_confirm.find('.btn-focus:last').focus();
                        });
                    } else {
                        $('input[type="submit"],button[type="submit"]', form).attr('disabled', false);
                        $('input.disabled,select.disabled').attr('disabled', true);
                        App.updateUniform('input.disabled,select.disabled');
                        $('input.disabled,select.disabled').removeClass('disabled');
                        if ($(form).data('list')) {
                            $('#' + $(form).data('list')).unwrap();
                        }
                    }
                }
                return false;
            },
            onkeyup: false,
            onclick: false,
            onfocusout: false,
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
        };
        jQuery.validator.addMethod("dateINA", function(value, element) {
            var check = false;
            var re = /^\d{1,2}-\d{1,2}-\d{4}$/;
            if (re.test(value)) {
                var adata = value.split('-');
                var gg = parseInt(adata[0], 10);
                var mm = parseInt(adata[1], 10);
                var aaaa = parseInt(adata[2], 10);
                var xdata = new Date(aaaa, mm - 1, gg);
                if ((xdata.getFullYear() === aaaa) && (xdata.getMonth() === mm - 1) && (xdata.getDate() === gg)) {
                    check = true;
                } else {
                    check = false;
                }
            } else {
                check = false;
            }
            return this.optional(element) || check;
        }, "Please enter a correct date");
        jQuery.validator.addMethod("monthINA", function(value, element) {
            var check = false;
            var re = /^\d{1,2}-\d{4}$/;
            if (re.test(value)) {
                check = true;
            } else {
                check = false;
            }
            return this.optional(element) || check;
        }, "Please enter a correct Month");
        jQuery.validator.addMethod("alphafirst", function(value, element) {
            var check = false;
            var re = /^[A-Za-z][A-Za-z0-9_]+$/;
            if (re.test(value)) {
                check = true;
            } else {
                check = false;
            }
            return this.optional(element) || check;
        }, "Huruf awal harus alfabet");
        jQuery.validator.addMethod("alphafirstpk", function(value, element) {
            var check = false;
            var temp =value.split(',');
            var num_error =0;
            for(var i =0; i < temp.length; i++){
                 var re2 = /^[A-Za-z][A-Za-z0-9_]+$/;
                 if(re2.test(temp[i])){
                     check =true;
                 }else{
                     check =false;
                 }
             }
            return this.optional(element) || check;
        }, "Huruf awal harus alfabet");
        var input_tgl_minimum_msg = '';
        var input_tgl_minimum_cek = function() {
            return input_tgl_minimum_msg;
        };
        jQuery.validator.addMethod("yearINA", function(value, element) {
            var check = false;
            var re = /^\d{4}$/;
            if (re.test(value)) {
                check = true;
            } else {
                check = false;
            }
            return this.optional(element) || check;
        }, "Please enter a correct Month");
        var input_tgl_minimum_msg = '';
        var input_tgl_minimum_cek = function() {
            return input_tgl_minimum_msg;
        };
        jQuery.validator.addMethod('input_tgl_minimum', function(value, element) {
            var cek = false;
            var bday = new Date();
            var tday = new Date();
            var birth = value.split('-');
            bday.setFullYear(parseInt(birth[2], 10), parseInt(birth[1], 10) - 1, parseInt(birth[0], 10));
            tday.setFullYear(<?php echo date('Y');?>, <?php echo date('m')-1;?>, <?php echo date('d');?>);

            if (bday > tday) {
                input_tgl_minimum_msg = $(element).data('pesan') + " (" + value + ")<br/><b>melebihi</b> Tanggal sekarang (<?php echo date('d-m-Y') ?>)";
            } else {
                cek = true;
            }
            return this.optional(element) || cek;
        }, input_tgl_minimum_cek);
        jQuery.validator.addMethod('mindate', function(value, element, options) {
            var cek = false;
            var bday = new Date();
            var tday = new Date();
            var birth = value.split('-');
            var today = options.split('-');
            bday.setFullYear(parseInt(birth[2], 10), parseInt(birth[1], 10) - 1, parseInt(birth[0], 10));
            tday.setFullYear(parseInt(today[2], 10), parseInt(today[1], 10) - 1, parseInt(today[0], 10));
            if (tday <= bday) {
                cek = true
            }
            return this.optional(element) || cek;
        }, 'Anda tidak memiliki akses menginput tanggal');
        var batas_umur_saksi_msg = '';
        var batas_umur_saksi_cek = function() {
            return batas_umur_saksi_msg;
        };
       
        var banding_tgl_le_msg = '';
        var banding_tgl_le_cek = function() {
            return banding_tgl_le_msg;
        };
        jQuery.validator.addMethod('banding_tgl_le', function(value, element, options) {
            var cek = false;
            var cekdate = value.split('-');
            var bandingDate = $(options).val().split('-');
            var bandingVals = new Date();
            var cekval = new Date();
            cekval.setFullYear(parseInt(cekdate[2], 10), parseInt(cekdate[1], 10) - 1, parseInt(cekdate[0], 10));
            bandingVals.setFullYear(parseInt(bandingDate[2], 10), parseInt(bandingDate[1], 10) - 1, parseInt(bandingDate[0], 10));
            if (cekval <= bandingVals) {
                banding_tgl_le_msg = $(element).data('pesan') + " (" + $(element).val() + ") <b>harus</b> <u>melebihi</u> " + $(options).data('pesan') + " (" + $(options).val() + ")";
            } else {
                cek = true;
            }
            return this.optional(element) || cek;
        }, banding_tgl_le_cek);
        var banding_tgl_lt_msg = '';
        var banding_tgl_lt_cek = function() {
            return banding_tgl_lt_msg;
        };
        jQuery.validator.addMethod('banding_tgl_lt', function(value, element, options) {
            var cek = false;
            var cekdate = value.split('-');
            var bandingDate = $(options).val().split('-');
            var bandingVals = new Date();
            var cekval = new Date();
            cekval.setFullYear(parseInt(cekdate[2], 10), parseInt(cekdate[1], 10) - 1, parseInt(cekdate[0], 10));
            bandingVals.setFullYear(parseInt(bandingDate[2], 10), parseInt(bandingDate[1], 10) - 1, parseInt(bandingDate[0], 10));
            if (cekval < bandingVals) {
                banding_tgl_lt_msg = $(element).data('pesan') + " (" + $(element).val() + ") <b>harus</b> <u>melebihi</u> atau <u>sama</u> dengan " + $(options).data('pesan') + " (" + $(options).val() + ")";
            } else {
                cek = true;
            }
            return this.optional(element) || cek;
        }, banding_tgl_lt_cek);
        var banding_tgl_ge_msg = '';
        var banding_tgl_ge_cek = function() {
            return banding_tgl_ge_msg;
        };
        jQuery.validator.addMethod('banding_tgl_ge', function(value, element, options) {
            var cek = false;
            var cekdate = value.split('-');
            var bandingDate = $(options).val().split('-');
            var bandingVals = new Date();
            var cekval = new Date();
            cekval.setFullYear(parseInt(cekdate[2], 10), parseInt(cekdate[1], 10) - 1, parseInt(cekdate[0], 10));
            bandingVals.setFullYear(parseInt(bandingDate[2], 10), parseInt(bandingDate[1], 10) - 1, parseInt(bandingDate[0], 10));
            if (cekval >= bandingVals) {
                banding_tgl_ge_msg = $(element).data('pesan') + " (" + $(element).val() + ") <b>tidak boleh</b> <u>melebihi</u> atau <u>sama</u> dengan " + $(options).data('pesan') + " (" + $(options).val() + ")";
            } else {
                cek = true;
            }
            return this.optional(element) || cek;
        }, banding_tgl_ge_cek);
        var banding_tgl_gt_msg = '';
        var banding_tgl_gt_cek = function() {
            return banding_tgl_gt_msg;
        };
        jQuery.validator.addMethod('banding_tgl_gt', function(value, element, options) {
            var cek = false;
            var cekdate = value.split('-');
            var bandingDate = $(options).val().split('-');
            var bandingVals = new Date();
            var cekval = new Date();
            cekval.setFullYear(parseInt(cekdate[2], 10), parseInt(cekdate[1], 10) - 1, parseInt(cekdate[0], 10));
            bandingVals.setFullYear(parseInt(bandingDate[2], 10), parseInt(bandingDate[1], 10) - 1, parseInt(bandingDate[0], 10));
            if (cekval > bandingVals) {
                banding_tgl_gt_msg = $(element).data('pesan') + " (" + $(element).val() + ") <b>tidak boleh</b> <u>melebihi</u> " + $(options).data('pesan') + " (" + $(options).val() + ")";
            } else {
                cek = true;
            }
            return this.optional(element) || cek;
        }, banding_tgl_gt_cek);
        var banding_kesamaan_dua_kolom_msg = '';
        var banding_kesamaan_dua_kolom_cek = function() {
            return banding_kesamaan_dua_kolom_msg;
        };
        jQuery.validator.addMethod('banding_kesamaan_dua_kolom', function(value, element, options) {
            var cek = false;
            var cekinput = value;
            var bandinginput = $(options).val();
            var pesanpembanding = '';
            if ($(options).data('pesan') != "") {
                pesanpembanding = " dan " + $(options).data('pesan');
            }
            if (cekinput != bandinginput) {
                banding_kesamaan_dua_kolom_msg = $(element).data('pesan') + pesanpembanding + " <b>tidak sesuai</b> ";
            } else {
                cek = true;
            }
            return this.optional(element) || cek;
        }, banding_kesamaan_dua_kolom_cek);
       
        jQuery.validator.addMethod("fileMin", function(value, element, options) {
            var cek = false;
            var numberRequired = options[0];
            var selector = options[1];
            var fields = $(selector+' tr', element.form);
            if (fields.length >= numberRequired) {
                cek = true;
            }
            return cek;
        }, jQuery.validator.format("File harus diisi"));
        $('#form_validation_modal').on('shown.bs.modal', function(e) {
            $('.btn-focus:last', this).focus();
        });
        $('#form_validation_modal').on('hidden.bs.modal', function(e) {
            $('#form_validation_place').html('');
        });
        $('#ajax_modal').on('hidden.bs.modal', function() {
            $(this).removeData('bs.modal');
        });
        $('.page-sidebar .ajaxify.start').click();

        $(document).on('click','.portlet > .portlet-title > .tools > .targetted-collapse, .portlet .portlet-title > .tools > .targetted-expand', function(e){
            e.preventDefault();
            var those =$(this).context.attributes['href'];
            var these =those.value;
            // console.log(those.context.hash);
            if($(this).hasClass("targetted-collapse")){
                $(this).removeClass("targetted-collapse").addClass("targetted-expand");
                if(these.charAt(0) == "#"){
                    $(these).slideUp(200);
                }
            }else{
                $(this).removeClass("targetted-expand").addClass("targetted-collapse");
                if(these.charAt(0) == "#"){
                    $(these).slideDown(200);
                }
            }
        });
        $(document).on('click', ".cari_biodata", function(e) {
            e.preventDefault();
            ajax_function(this);
        });
        $(document).on('click', '.reset_biodata', function(e) {
            e.preventDefault();
            reset_ajax(this);
        });
        $(document).on('click', '.btnCetak, .btnPreview', function(e) {
            e.preventDefault();
            var target = ($(this).data('target')) ? 'data-target="' + $(this).data('target') + '"' : '';
            var hidden = ($(this).data('hidden')) ? 'data-hidden="' + $(this).data('hidden') + '"' : '';
            var konfirmasi = ($(this).data('konfirmasi')) ? 'data-konfirmasi="' + $(this).data('konfirmasi') + '"' : 'data-konfirmasi="Apakah data ini ingin di cetak?"';
            var refresh = ($(this).data('refresh')) ? 'data-refresh="' + $(this).data('refresh') + '"' : '';
            var nondisable = ($(this).data('nondisable')) ? 'data-nondisable="' + $(this).data('nondisable') + '"' : '';
            $('#' + $(this).data('list')).wrap('<form id="frm_cetak" action="' + $(this).data('action') + '" data-list="' + $(this).data('list') + '" method="post" ' + target + ' ' + hidden + ' ' + konfirmasi + ' ' + refresh + ' ' + nondisable + ' />');
            $('#frm_cetak').validate(option_form);
            //$('#frm_cetak').data('validator').settings.ignore = '';
            $('#frm_cetak').submit();
        });
        $(document).on('click', '.btnKendaliBlangko', function(e) {
            e.preventDefault();
            var target = ($(this).data('target')) ? 'data-target="' + $(this).data('target') + '"' : '';
            var hidden = ($(this).data('hidden')) ? 'data-hidden="' + $(this).data('hidden') + '"' : '';
            var konfirmasi = ($(this).data('konfirmasi')) ? 'data-konfirmasi="' + $(this).data('konfirmasi') + '"' : 'data-konfirmasi="Apakah data ini ingin di cetak?"';
            var refresh = ($(this).data('refresh')) ? 'data-refresh="' + $(this).data('refresh') + '"' : '';
            var nondisable = ($(this).data('nondisable')) ? 'data-nondisable="' + $(this).data('nondisable') + '"' : '';
            $('#' + $(this).data('list')).wrap('<form id="frm_editKendali" action="'  + $(this).data('action') + '" data-list="' + $(this).data('list') + '" method="post" ' + target + ' ' + hidden + ' ' + konfirmasi + ' ' + refresh + ' ' + nondisable + ' />');
            var listKendali=$('.check_kendali',$('#'+$(this).data('list'))).map(function(){
                return $(this).attr('name');
            }).get().join(' ');
            console.log(listKendali);
            var optionsFormKendali=$.extend({groups:{"listKendali":listKendali}}, option_form);
            $('#frm_editKendali').validate(optionsFormKendali);
            $('#frm_editKendali').data('validator').settings.ignore = '';
            $('#frm_editKendali').submit();
        });
        $(document).on('focus', 'select.readonly', function() {
            this.defaultIndex = this.selectedIndex;
        });
        $(document).on('change', 'select.readonly', function(e) {
            e.preventDefault();
            this.selectedIndex = this.defaultIndex;
        });
        //pasang notifikasi
        $('.notifikasi').each(function(i){
            notifikasi($(this));
        });

    });

    function ajax_function(object_html) {
        if (!$(object_html).data('noblock')) {
            App.blockUI({
                boxed: true,
                message: 'Harap Tunggu...'
            });
        }
        url_post = $(object_html).data('url');
        parameter_input = $(object_html).data('parameter');
        var parameter_post = '';
        for (var key in parameter_input) {
            if (parameter_post == '') {
                parameter_post += encodeURIComponent(key) + '=' + encodeURIComponent($('#' + parameter_input[key]).val());
            } else {
                parameter_post += "&" + encodeURIComponent(key) + '=' + encodeURIComponent($('#' + parameter_input[key]).val());
            }
        }
        map = $(object_html).data('map');
        $.ajax({
            type: "POST",
            url: url_post,
            data: parameter_post
        }).done(function(msg) {
            if (msg.charAt(0) == '{') {
                var json = $.parseJSON(msg);
                if (json.status == 0) {
                    dialog_alert = bootbox.alert({
                        title: 'Pesan',
                        className: "konfirmasi-simpan",
                        message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                        buttons: {
                            'ok': {
                                label: 'Ya',
                                className: 'btn btn-danger btn-sm btn-focus'
                            }
                        }
                    });
                    dialog_alert.find('.modal-body').addClass('alert-danger');
                    dialog_alert.find('.modal-body').addClass('portlet-body');
                    $(dialog_alert).on('shown.bs.modal', function(e) {
                        dialog_alert.find('.btn-focus:last').focus();
                    });
                    var i = 0;
                    for (key in parameter_input) {
                        if (i == 0) {
                            if ($('#' + parameter_input[key]).is('select')) {
                                $('#' + parameter_input[key]).val('0');
                                $('#' + parameter_input[key]).select_readonly(false);
                            } else if ($('#' + parameter_input[key]).is(':text')) {
                                $('#' + parameter_input[key]).attr('readonly', false);
                                $('#' + parameter_input[key]).val('');
                            }
                        }
                        i++;
                    }
                    reset_ajax(object_html);
                    App.unblockUI();
                    if (typeof json.javascript != 'undefined') {
                        eval(json.javascript);
                    }
                } else if (json.status == 2) {
                    App.unblockUI();
                    dialog_confirm = bootbox.confirm({
                        title: 'PESAN',
                        className: "konfirmasi-simpan",
                        message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-question-circle"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-info no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                        buttons: {
                            'confirm': {
                                label: 'Ya',
                                className: 'btn btn-success min-width margin-right btn-sm btn-focus'
                            },
                            'cancel': {
                                label: 'Batal',
                                className: 'btn btn-danger pull-right btn-sm'
                            },
                        },
                        callback: function(result) {
                            if (result) {
                                for (key in map) {
                                    if ($('#' + key).data('valid')) {
                                        $('#' + key).data('src', $(object_html).attr('id'));
                                    }
                                }
                                for (key in parameter_input) {
                                    if (i == 0) {
                                        if ($('#' + parameter_input[key]).is('select')) {
                                            $('#' + parameter_input[key]).val('0');
                                            $('#' + parameter_input[key]).select_readonly(true);
                                        } else if ($('#' + parameter_input[key]).is(':text')) {
                                            $('#' + parameter_input[key]).attr('readonly', true);
                                            $('#' + parameter_input[key]).val('');
                                        } else if ($('#' + parameter_input[key]).is('img')) {
                                            $('#' + parameter_input[key]).removeAttr('src').attr('src', $('#' + parameter_input[key]).data('srconreset')+"?_="+new Date().getTime());
                                        }
                                    }
                                    i++;
                                }
                                if ($(object_html).attr('data-terkait')) {
                                    $($(object_html).data('terkait')).removeClass('hidden');
                                    if ($(object_html).attr('data-kirim')) {
                                        $($(object_html).data('terkait')).attr('href', "<?=base_url()?>" + $($(object_html).data('terkait')).data('tautan') + $($(object_html).data('kirim')).val());
                                    }
                                }
                                $(object_html).removeClass('cari_biodata');
                                $(object_html).removeClass('yellow');
                                $(object_html).addClass('reset_biodata');
                                $(object_html).addClass('blue');
                            } else {
                                var i = 0;
                                for (key in parameter_input) {
                                    if (i == 0) {
                                        if ($('#' + parameter_input[key]).is('select')) {
                                            $('#' + parameter_input[key]).val('0');
                                            $('#' + parameter_input[key]).select_readonly(false);
                                        } else if ($('#' + parameter_input[key]).is(':text')) {
                                            $('#' + parameter_input[key]).attr('readonly', false);
                                            $('#' + parameter_input[key]).val('');
                                        } else if ($('#' + parameter_input[key]).is('img')) {
                                            $('#' + parameter_input[key]).removeAttr('src').attr('src', $('#' + parameter_input[key]).data('srconreset')+"?_="+new Date().getTime());
                                        }
                                    }
                                    i++;
                                }
                                reset_ajax(object_html);
                            }
                        }
                    });
                    dialog_confirm.find('.modal-body').addClass('alert-info');
                    dialog_confirm.find('.modal-dialog').css('width', '34%');
                    $(dialog_confirm).on('shown.bs.modal', function(e) {
                        dialog_confirm.find('.btn-focus:last').focus();
                    });
                } else {
                    if (typeof json.data != 'undefined') {
                        if(typeof json.pesan != 'undefined'){
                            dialog_alert = bootbox.alert({
                                title: 'PESAN',
                                className: "konfirmasi-simpan",
                                message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-check"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-success no-bullets"><label><li>' + json.pesan + '</li></label></ul></div>' + '</div>' + '</div>',
                                buttons: {
                                    'ok': {
                                        label: 'Ya',
                                        className: 'btn btn-success btn-sm btn-focus'
                                    }
                                }
                            });
                            dialog_alert.find('.modal-body').addClass('alert-success');
                            dialog_alert.find('.modal-body').addClass('portlet-body');
                            $(dialog_alert).on('shown.bs.modal', function(e) {
                                dialog_alert.find('.btn-focus:last').focus();
                            });
                        }
                        for (key in map) {
                            if (typeof json.data[map[key]] != 'undefined') {
                                if ($('#' + key).is('input') || $('#' + key).is('select')) {
                                    if (typeof json.data[map[key]] === 'string' || typeof json.data[map[key]] === 'number') {
                                        $('#' + key).val(json.data[map[key]]);
                                    } else if (json.data[map[key]] == null) {
                                        $('#' + key).val('');
                                    } else {
                                        $("#" + key).empty();
                                        if (json.data[map[key]]['value']) {
                                            $("#" + key).append($('<option></option>').attr("value", json.data[map[key]]['value']).text(json.data[map[key]]['text']));
                                            $('#' + key).val(json.data[map[key]]['value']);
                                        } else {
                                            for (var i = 0; i < json.data[map[key]].length; i++) {
                                                $("#" + key).append($('<option></option>').attr("value", json.data[map[key]][i]['value']).text(json.data[map[key]][i]['text']));
                                            }
                                            $('#' + key).val(json.data[map[key] + 'default']);
                                        }
                                    }
                                    if ($('#' + key).data('valid')) {
                                        if ($('#' + key).is('select')) {
                                            $('#' + key).select_readonly();
                                        } else {
                                            $('#' + key).attr('readonly', true);
                                        }
                                    }
                                } else if ($('#' + key).is('img')) {
                                    $('#' + key).removeAttr('src').attr('src', json.data[map[key]]);
                                } else {
                                    if (json.data[map[key]] == null) {
                                        $('#' + key).html('');
                                    } else {
                                        $('#' + key).html(json.data[map[key]]);
                                    }
                                }
                                $('#' + key).data('src', $(object_html).attr('id'));
                            }
                        }
                        if ($(object_html).hasClass('cari_biodata')) {
                            if ($(object_html).attr('data-terkait')) {
                                $($(object_html).data('terkait')).removeClass('hidden');
                                if ($(object_html).attr('data-kirim')) {
                                    $($(object_html).data('terkait')).attr('href', "<?=base_url()?>" + $($(object_html).data('terkait')).data('tautan') + $($(object_html).data('kirim')).val());
                                }
                            }
                            $(object_html).removeClass('cari_biodata');
                            $(object_html).removeClass('yellow');
                            $(object_html).addClass('reset_biodata');
                            $(object_html).addClass('blue');
                            for (key in parameter_input) {
                                if ($('#' + parameter_input[key], $(object_html).parents('.input-group')).is('select')) {
                                    $('#' + parameter_input[key], $(object_html).parents('.input-group')).select_readonly();
                                } else if ($('#' + parameter_input[key]).is('input'), $(object_html).parents('.input-group')) {
                                    $('#' + parameter_input[key], $(object_html).parents('.input-group')).attr('readonly', true);
                                }
                            }
                        }
                    }
                    App.unblockUI();
                    if (typeof json.javascript != 'undefined') {
                        eval(json.javascript);
                    }
                }
            } else {
                dialog_alert = bootbox.alert({
                    title: 'Pesan',
                    className: "konfirmasi-simpan",
                    message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + msg + '</li></label></ul></div>' + '</div>' + '</div>',
                    buttons: {
                        'ok': {
                            label: 'Ya',
                            className: 'btn btn-danger btn-sm btn-focus'
                        }
                    }
                });
                dialog_alert.find('.modal-body').addClass('alert-danger');
                dialog_alert.find('.modal-body').addClass('portlet-body');
                $(dialog_alert).on('shown.bs.modal', function(e) {
                    dialog_alert.find('.btn-focus:last').focus();
                });
                reset_ajax(object_html);
                App.unblockUI();
                if (typeof json.javascript != 'undefined') {
                    eval(json.javascript);
                }
            }
        });
    }

    function reset_ajax(object_html) {
        map = $(object_html).data('map');
        parameter_input = $(object_html).data('parameter');
        for (key in map) {
            if ($('#' + key).data('src') == $(object_html).attr('id')) {
                if ($('#' + key).is('select')) {
                    $('#' + key).val('0');
                    $('#' + key).select_readonly(false);
                    App.updateUniform('#' + key);
                } else if ($('#' + key).is('input')) {
                    $('#' + key).attr('readonly', false);
                    $('#' + key).val('');
                    App.updateUniform('#' + key);
                }  else if ($('#' + key).is('img')) {
                    $('#' + key).removeAttr('src').attr('src', $('#' + key).data('srconreset')+"?_="+new Date().getTime());
                    App.updateUniform('#' + key);
                } else {
                    $('#' + key).html('');
                }
            }
        }
        if ($(object_html).hasClass('reset_biodata')) {
            if ($(object_html).attr('data-terkait')) {
                $($(object_html).data('terkait')).addClass('hidden');
            }

            if ($(object_html).attr('data-resetrespon')) {
                $($(object_html).data('resetrespon')).val('');
            }

            if ($(object_html).attr('data-disablesubmitbtn')) {
                $($(object_html).data('disablesubmitbtn')).addClass('disabled');
            }
            if ($(object_html).attr('data-cekniknull')) {
                var cek_nik_nol = $(object_html).data('cekniknull').split('=');
                $('#' + $.trim(cek_nik_nol[0])).val($.trim(cek_nik_nol[1]) + "=0");
            }
            $(object_html).removeClass('reset_biodata');
            $(object_html).removeClass('blue');
            $(object_html).addClass('cari_biodata');
            $(object_html).addClass('yellow');
            var i = 0;
            for (key in parameter_input) {
                if (i == 0) {
                    if ($('#' + parameter_input[key]).is('select')) {
                        $('#' + parameter_input[key]).val('0');
                        $('#' + parameter_input[key]).select_readonly(false);
                    } else if ($('#' + parameter_input[key]).is(':text')) {
                        $('#' + parameter_input[key]).attr('readonly', false);
                        $('#' + parameter_input[key]).val('');
                    } else if ($('#' + parameter_input[key]).is('img')) {
                        $('#' + parameter_input[key]).removeAttr('src').attr('src', $('#' + parameter_input[key]).data('srconreset')+"?_="+new Date().getTime());
                    }
                }
                i++;
            }
        }
    }

    function AgeYearServer(monthDob, dayDob, yearDob, yearNow, monthNow, dayNow) {
        if (yearNow < 100) {
            yearNow = yearNow + 1900;
        }
        monthDob++;
        yearAge = yearNow - yearDob;
        if (monthNow <= monthDob) {
            if (monthNow < monthDob) {
                yearAge--;
            } else {
                if (dayNow < dayDob) {
                    yearAge--;
                }
            }
        }
        return yearAge;
    }

    function siakDiffDay(vFirstDate, vSecondDate) {
        var oneDay = 24 * 60 * 60 * 1000;
        return Math.round(Math.abs((vFirstDate.getTime() - vSecondDate.getTime()) / (oneDay)));
    }

    function siakValidDate(text) {
        var comp = text.split('-');
        var d = parseInt(comp[0], 10);
        var m = parseInt(comp[1], 10);
        var y = parseInt(comp[2], 10);
        if (isNaN(d)) {
            return false;
        }
        if (isNaN(m)) {
            return false;
        }
        if (isNaN(y)) {
            return false;
        }
        if (String(d).length < 1) {
            return false;
        }
        if (String(m).length < 1) {
            return false;
        }
        if (String(y).length < 4) {
            return false;
        }
        var date = new Date(y, m - 1, d);
        if (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d) {
            return true;
        }
        return false;
    }

    function showDialogError(myPesan) {
        $('#form_validation_place').html(myPesan);
        $('#form_validation_place').show();
        $('#form_validation_modal').modal('show');
    }

    function tooltip_grafik(label, x, y, flotItem) {
        var nomor = y.toString().split('.');
        var pecahan = nomor[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        if (typeof nomor[1] == 'undefined') {
            return flotItem.series.xaxis.ticks[x].label + ': ' + pecahan;
        }
        return flotItem.series.xaxis.ticks[x].label + ': ' + pecahan + ',' + nomor[1];
    }

    function axis_indonesia(val) {
        var nomor = val.toString().split('.');
        var pecahan = nomor[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        if (typeof nomor[1] == 'undefined') {
            return pecahan;
        }
        return pecahan + ',' + nomor[1];
    }

    function showAlertErrorUpload(pesan) {
        dialog_alert = bootbox.alert({
            title: 'PESAN',
            className: "konfirmasi-simpan",
            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + pesan + '</li></label></ul></div>' + '</div>' + '</div>',
            buttons: {
                'ok': {
                    label: 'Tutup',
                    className: 'btn btn-danger btn-sm btn-focus'
                }
            }
        });
        dialog_alert.find('.modal-body').addClass('alert-danger');
        dialog_alert.find('.modal-body').addClass('portlet-body');
        return dialog_alert;
    }

    function showAlertErrorCamera(pesan) {
        dialog_alert = bootbox.alert({
            title: 'PESAN',
            className: "konfirmasi-simpan",
            message: '<div class="row">' + '<div class="col-md-12">' + '<div class="col-md-2">' + '<i class="fa fa-3x fa-warning"></i>' + '</div>' + '<div class="col-md-10"><ul class="text-danger no-bullets"><label class="error"><li>' + pesan + '</li></label></ul></div>' + '</div>' + '</div>',
            buttons: {
                'ok': {
                    label: 'Tutup',
                    className: 'btn btn-danger btn-sm btn-focus'
                }
            }
        });
        dialog_alert.find('.modal-body').addClass('alert-danger');
        dialog_alert.find('.modal-body').addClass('portlet-body');
        return dialog_alert;
    }
</script>
	</head>
	<!-- END HEAD -->

	<!-- BEGIN BODY -->
	<body class="page-quick-sidebar-over-content page-full-width" id="warna">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		
		<!-- END LOGO -->
		<!-- BEGIN HORIZANTAL MENU -->
		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
		<div class="header">
				<!-- BEGIN TOP NAVIGATION BAR -->
				<?php $this->load->view('boot/top');?>
				<!-- END TOP NAVIGATION BAR -->
		</div>
		
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>

<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" id="page-content">
		</div>
	</div>
	<div class="modal fade in konfirmasi-simpan" id="form_validation_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">PESAN</h4>
				</div>
				<div class="modal-body alert-danger">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-2"><i class='fa fa-3x fa-address-card'></i></div>
							<div class="col-md-10"><ul id="form_validation_place" class="text-danger"><!-- HERE WILL BE LOADED AN AJAX DIALOG VALIDATION MESSAGE --></ul></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-focus" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!--<?php //$this->load->view('boot/bottom')?>-->
</body><!-- END BODY -->
	<!-- END BODY -->
</html>

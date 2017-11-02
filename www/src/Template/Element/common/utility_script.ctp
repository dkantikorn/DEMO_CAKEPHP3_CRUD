<script type="text/javascript">
    ﻿﻿﻿ /**
     | ------------------------------------------------------------------------------------------------------------------
     | Packgon main package action eacl all in Warehouse system
     | @author  Sarawutt.b
     | @since   2016/03/02 14:22:35
     | @license Pakgon Ltd ,Company
     | ------------------------------------------------------------------------------------------------------------------
     | ------------------------------------------------------------------------------------------------------------------
     */

            var _modalTitle = '<?php echo __('Are you sure process the action ?'); ?>';
    var _modalMessageTitle = '<?php echo __('Application process status.'); ?>';
    var _appMessageTitle = '<?php echo __('Application process status.'); ?>';
    var _modalConfirmMessage = '<?php echo __('Are you sure process the action ?'); ?>';
    //Fixed for chosen has class validated must be valid
    $.validator.setDefaults({
        ignore: ':hidden:not(select)',
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.insertBefore(element.parent());
            } else if (element.prop('type') == 'text') {
                error.insertAfter(element);
            } else if (element.is('select')) {
                error.insertAfter(element.siblings(".chosen-container"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).addClass(errorClass).removeClass(validClass);
            } else if (element.type === "text") {
                $(element).closest('div').removeClass('has-success has-feedback').addClass('has-error');
            } else {
                $(element).closest('div').removeClass('has-success has-feedback').addClass('has-error');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if (element.type === "radio") {
                this.findByName(element.name).removeClass(errorClass);
            } else if (element.type === "text") {
                $(element).closest('div').removeClass('has-error has-feedback');
            } else {
                $(element).closest('div').removeClass('has-error has-feedback');
            }
        }
    });
    //$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $(function () {
        var _ajaxProgress = null;
        NProgress.start();
        setTimeout(function () {
            NProgress.done();
            $('.fade').removeClass('out');
        }, 1000);

        /**
         * 
         * Automatically closing for the application notification
         * Alert dialog on Flash alert status
         * @author  sarawutt.b
         */
        fadeoutNotification();
        //lookup for .action-cancel , .action-delete-submit and remove onclick attribuite
        $('.action-cancel,.action-delete-submit').attr('onclick', null);
        //index page has show delete and cancel button ask for confirm before delete Or cancel
        //if actor click to confirm then update data where condition correcly in the database
        $("a.action-cancel,a.action-delete-submit").on('click', function () {
            $this = $(this);
            var confirmTitle = $this.attr('data-confirm-title') || '<?php echo __('Are you sure for delete ?'); ?>';
            var confirmMessage = $this.attr('data-confirm-message') || '<?php echo __('Are you sure for delete ?'); ?>';
            confirmModal(confirmTitle, confirmMessage, function (result) {
                $('#flashMessage').remove();
                if (result == true) {
                    $this.parent().find('form').submit();
                } else {
                    return false;
                }
            });
        });

        /**
         * Aplication default notification style
         * @author  sarawutt.b
         * @param   handler object
         * @returns void
         */
        $('.noti-default').on('click', function (e) {
            appNoti($(this), e);
        });
        /**
         * Aplication success notification style
         * @author  sarawutt.b
         * @param   handler object
         * @returns void
         */
        $('.noti-success').on('click', function (e) {
            appNoti($(this), e, 'success');
        });
        /**
         * Aplication infomation notification style
         * @author  sarawutt.b
         * @param   handler object
         * @returns void
         */
        $('.noti-info').on('click', function (e) {
            appNoti($(this), e, 'info');
        });
        /**
         * Aplication danger or error notification style
         * @author  sarawutt.b
         * @param   handler object
         * @returns void
         */
        $('.noti-danger').on('click', function (e) {
            appNoti($(this), e, 'danger');
        });
        /**
         * Aplication warning notification style
         * @author  sarawutt.b
         * @param   handler object
         * @returns void
         */
        $('.noti-warning').on('click', function (e) {
            appNoti($(this), e, 'warning');
        });


//        /**
//         * 
//         * Automatically closing for the application notification
//         * Alert dialog on Flash alert status
//         * @author  sarawutt.b
//         */
//        $(".alert").delay(7000).fadeOut("slow", function () {
//            $(this).remove();
//        });

        /**
         * 
         * Function remove trigger whern chosen select validation change value
         * @author  sarawutt.b
         * @return boolean
         */
        $('select').change(function () {
            var self = $(this).closest('div');
            var _value = $(this).val();
            if ((_value != '') || (_value != undefined)) {
                //self.removeClass('has-error has-feedback').addClass('has-success');
                self.removeClass('has-error has-feedback');
                self.find('span.help-block').remove();
            }
            return true;
        });


        /**
         * make for chosen for a hidden name benerfit for validation rule
         */
        $('.chosen-search input').attr('name', 'chosen-search-name');

        /**
         * 
         * Input currency where has class currentcy
         * @param {type} e
         * @returns {undefined}
         */
//        $("input[type='text'].currency,input[type='hidden'].currency,input[type='number']").autoNumeric('init', {aSep: ',', aDec: '.', aSign: '฿ '});
        $("input[type='text'].currency,input[type='hidden'].currency,input[type='number']").autoNumeric('init', {aSep: ',', aDec: '.'});
        /**
         * Update chosen width style
         * @author  sarawutt.b
         * @since   2016/06/24
         */
        $("a.sidebar-toggle").click(function (e) {
            $(".chosen-container").css('width', '100%');
        });
        /**
         * Dynamic set current menu to active class
         * @author  sarawutt.b
         * @since   2016/05/25
         */
        var url = window.location;
        $('ul.sidebar-menu li.treeview ul.treeview-menu li a[href="' + this.location.pathname + '"]').parents('li').addClass('active');
        $('nav>ul>li>a[href="' + this.location.pathname + '"]').parents('li').addClass('active');

        //build cake generate code to bootstrap style
        if (!$('div.input:not(.simple), div.text:not(.simple)').hasClass('form-group')) {
            $('div.input:not(.simple), div.text:not(.simple)').addClass('form-group');
        }
        if (!$('input[type="text"]:not(.simple),select:not(.simple)').hasClass('form-control')) {
            $('input[type="text"]:not(.simple),select:not(.simple)').addClass('form-control');
        }

        $("#UserPicturePath").removeClass('form-control');
        $('input[type="file"]').removeClass('form-control');
        /**
         * Generate placeholder to each input not has class simple
         * @author  Sarawutt.b
         * @since   2016/04/01 10:00
         */
        $('input[type="text"]:not(.simple)').each(function () {
            $this = $(this);
            $label = $('label[for="' + $this.attr('id') + '"]');
            if ($('input#' + $this.attr('id')).attr('placeholder') == undefined) {
                $('input#' + $this.attr('id')).attr('placeholder', $label.text());
            }
        });
        /**
         * Generate placeholder to each input not has class simple
         * @author  Sarawutt.b
         * @since   2016/07/23 20:30
         */
        $('textarea:not(.simple)').each(function () {
            $this = $(this);
            $label = $('label[for="' + $this.attr('id') + '"]');
            if ($('textarea#' + $this.attr('id')).attr('placeholder') == undefined) {
                $('textarea#' + $this.attr('id')).attr('placeholder', $label.text());
            }
        });

        //Chosen version 1.5.1 make select list is beauty
        //Adding by sarawutt.b
        $('select:not(.simple)').addClass('chosen-select');
        makeChosen();
        $('div.chosen-search input[type="text"]').attr('name', 'chosensearch[]');
        $('input[type="submit"]:not(.simple)').addClass('btn btn-primary');
        $('input[type="reset"]:not(.simple)').addClass('btn btn-default');
        $('form').attr('role', 'form'); //Adding form role attribute
        $("input[type='text'].datepicker").focus(function () {
            $(".ui-datepicker-year").text(parseInt($(".ui-datepicker-year").text()) + 543);
        });

        /**
         * 
         * Function find input where is type text has class datetime-picker rander to datetime-picker dialog
         * @author  Sarawutt.b
         * @return  void
         */
        $('input[type="text"].datetime-picker').wrap('<div class="input-group"></div>').before('<div class="input-group-addon"><i class="fa fa-calendar"></i></div>').datetimepicker({
            isRTL: false,
            format: 'YYYY-MM-DD HH:mm',
            autoclose: true,
            language: 'th'
        });
        /**
         * 
         * Function find input where is type text has class date-picker rander to datet-picker dialog
         * @author  Sarawutt.b
         * @return  void
         */
        $('input[type="text"].datepicker').wrap('<div class="input-group"></div>').before('<div class="input-group-addon"><i class="fa fa-calendar"></i></div>').datetimepicker({
            isRTL: false,
            pickTime: false,
            format: 'YYYY-MM-DD',
            autoclose: true,
            language: 'th'
        });

        /**
         * 
         * Function set minDate to seccond datepicker input (where has class datepicker-end | datetimepicker-end)
         * @author  sarawutt.b
         * @returns void
         */
        $('.datepicker-start,.datetimepicker-start').on('dp.change', function (selected) {
            $(".datepicker-end,.datetimepicker-end").data("DateTimePicker").setMinDate(selected.date);
        });

        if ($(".datepicker-end,.datetimepicker-end").length > 0) {
            $(".datepicker-end,.datetimepicker-end").datetimepicker().data("DateTimePicker").setMinDate($('.datepicker-start,.datetimepicker-start').val());
        }


        $("div.index table, div.related table,div.view-related table.table-view-related,.table-view-related,.table-short-information").addClass('table table-bordered table-striped');//.find('tr:first').css('background-color', '#CFCFCF');
        $("table.table-form-view").addClass('table table-striped');

        var tmpController = $(location).attr('pathname').split('/');
        var url = $(location).attr('protocol') + '//' + $(location).attr('host') + '/' + tmpController[1] + '/add';
        //Generate addindig button on index page display on above table
        $('div.index h1').wrap('<div class="row"><div class="col-md-8"></div><div class="col-md-4"><a href="' + url + '" class="btn btn-success pull-right btn-add-item"><i class="fa fa-plus"></i><?php echo __('Add'); ?></a></div></div>');
        //Generate delete action to modal style
        $("td.actions:not(.simple)").each(function () {
            $(this).find('span.glyphicon-search').parent('a').attr('title', '<?php echo __('View more infomation'); ?>');
            $(this).find('span.glyphicon-edit').parent('a').attr('title', '<?php echo __('Edit'); ?>');
            $(this).find('span.glyphicon-remove').parent('a').addClass('action-delete').attr('onclick', false).attr('title', '<?php echo __('Delete'); ?>');
        });

        //index page has show delete button ask for confirm before delete
        //if actor click to confirm then delete data where condition correcly in the database
        $("a.action-delete").on('click', function () {
            $this = $(this);
            confirmModal('<?php echo __('Are you sure for delete ?'); ?>', function (result) {
                $("section.content div.alert").remove();
                console.log(result);
                if (result == true) {
                    var url = $(location).attr('protocol') + '//' + $(location).attr('host') + $this.prev().attr('action');
                    $.post(url, function (data, status) {
                        $("section.content div.alert").remove();

                        try {
                            var tmpJson = $.parseJSON(data);
                        } catch (error) {
                            var tmpJson = {message: $.trim($(data).filter('p').text()), class: 'success'};
                        }

                        var msg = tmpJson.message || '<?php echo __('Successfully'); ?>';
                        var bclass = tmpJson.class || 'info';
                        if (status == 'success') {
                            if ($this.hasClass('btnGroupMenu')) {
                                $this.parent().parent().parent().parent().parent().remove();
                            } else {
                                $this.parent().parent().remove();
                            }
                            $("section.content div:first").before(buildTopAlertMessage(msg, bclass));
                            return true;
                        } else {
                            $("section.content div:first").before(buildTopAlertMessage(msg, 'danger'));
                            return false;
                        }
                        return;
                    });
                } else {
                    return false;
                }
            });


//                    $("#ConfirmModal").modal("show");
//                    $("section.content div.alert").remove();
//                    $('#loading-indicator').show();
//                    $("#btnConfirm").click(function () {
//                        var url = $(location).attr('protocol') + '//' + $(location).attr('host') + $this.prev().attr('action');
//                        $.post(url, function (data, status) {
//                            $("section.content div.alert").remove();
//                            var msg = $.trim($(data).filter('p').text());
//                            if (status == 'success') {
//                                $this.parent().parent().remove();
//                                $("section.content div:first").before(buildTopAlertMessage(msg, 'success'));
//                                return true;
//                            } else {
//                                $("section.content div:first").before(buildTopAlertMessage(msg, 'danger'));
//                                return false;
//                            }
//                            //$('#loading-indicator').hide();
//                            return;
//                        });
//                    });
        });
        //Remove action link code generate by cakephp
        $("div.actions").remove();
        $("div.related").remove();
        $("div.form div.submit").find('input[type="submit"]').after('<input type="button" class="btn btn-default btn-back" name="btn-back" value="<?php echo __('Back'); ?>" onclick="window.history.back();"/>');
        $("div.view table").after('<div class="submit"><input type="button" class="btn btn-default btn-back" name="btn-back" value="<?php echo __('Back'); ?>" onclick="window.history.back();"/></div>');
        /*
         * We are gonna initialize all checkbox and radio inputs to 
         * iCheck plugin in.
         * You can find the documentation at http://fronteed.com/iCheck/
         */
        $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
        });
        //$("#flashMessage").addClass('alert alert-info');
        $(document).ajaxSend(function (event, request, settings) {
            //$('#loading-indicator').show();
            //Pace.start();
            NProgress.start();
            NProgress.inc();
            //setInterval(function(){NProgress.inc();},500);
            //setInterval(function(){NProgress.inc();},500);
        });
        $(document).ajaxComplete(function (event, request, settings) {
            //$('#loading-indicator').hide();
            //Pace.stop();
            NProgress.done();
//            $('.fade').removeClass('out');
//            clearInterval(setInterval(function(){NProgress.inc();},500));
        });
//notification of cake buid css
        $("#flashMessage").dialog({
            title: _appMessageTitle,
            modal: true,
            width: '70%',
            height: 'auto',
            autoOpen: true,
            dialogClass: 'alert-dialog-responsive',
            closeOnEscape: true,
            buttons: {
                '<?php echo __('OK'); ?>': function () {
                    $(this).dialog("close");
                }
            }
        });

        //making for notification application message
        var appMessage = '<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="margin: 0 0 20px 0; padding: 0 .7em;"> <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Appication Message : </strong> ' + $("#appMessageMessage").text() + '</p></div></div>';
        $("#appMessageMessage").html(appMessage);

        //making for notification error message
        var errorMessage = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="margin: 0 0 20px 0; padding: 0 .7em;"> <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>ERROR Message : </strong> ' + $("#errorMessageMessage").text() + '</p></div></div>';
        $("#errorMessageMessageHTML").html(errorMessage);
        $("#appMessage").dialog({
            title: _appMessageTitle,
            modal: true,
            width: '70%',
            height: 'auto',
            autoOpen: false,
            dialogClass: 'alert-dialog-responsive',
            closeOnEscape: true,
            buttons: {
                '<?php echo __('OK'); ?>': function () {
                    $(this).dialog("close");
                }
            }
        });

        $("#confirmDialog").dialog({
            modal: true,
            bgiframe: true,
            width: '70%',
            height: 'auto',
            autoOpen: false,
            dialogClass: 'alert-dialog-responsive',
            closeOnEscape: true,
            title: _modalTitle
        });
        $("a.confirmButton").click(function (link) {
            link.preventDefault();
            var theHREF = $(this).attr("href");
            _modalTitle = ($(this).attr("data-confirm-title") || $(this).attr("btitle")) || _modalTitle;
            var theMESSAGE = ($(this).attr("data-confirm-message") || $(this).attr("rel")) || _modalConfirmMessage;
            var theICON = '<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>';
            $('#confirmDialog').html('<P>' + theICON + theMESSAGE + '</P>');
            $("#confirmDialog").dialog('option', 'buttons', {
                '<?php echo __('OK'); ?>': function () {
                    window.location.href = theHREF;
                },
                '<?php echo __('Cancel'); ?>': function () {
                    $(this).dialog("close");
                }
            });
            $("#confirmDialog").dialog("open");
        });
        $("input.confirmButton,input[type='submit'].confirmButton").click(function (theINPUT) {
            theINPUT.preventDefault();
            var theFORM = $(theINPUT.target).closest("form");
            _modalTitle = ($(this).attr("data-confirm-title") || $(this).attr("btitle")) || _modalTitle;
            var theMESSAGE = ($(this).attr("data-confirm-message") || $(this).attr("rel")) || _modalConfirmMessage;
            var theICON = '<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>';
            $('#confirmDialog').html('<P>' + theICON + theMESSAGE + '</P>');
            $("#confirmDialog").dialog('option', 'buttons', {
                '<?php echo __('OK'); ?>': function () {
                    theFORM.submit();
                },
                '<?php echo __('Cancel'); ?>': function () {
                    $(this).dialog("close");
                }
            });
            $("#confirmDialog").dialog("open");
        });
        $("button.confirmButton,input[type='button'].confirmButton").click(function (theINPUT) {
            theINPUT.preventDefault();
            var theFORM = $(theINPUT.target).closest("form");
            _modalTitle = ($(this).attr("data-confirm-title") || $(this).attr("btitle")) || _modalTitle;
            var theMESSAGE = ($(this).attr("data-confirm-message") || $(this).attr("rel")) || _modalConfirmMessage;
            var action = $(this).attr('action');
            var theICON = '<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>';
            $('#confirmDialog').html('<P>' + theICON + theMESSAGE + '</P>');
            $("#confirmDialog").dialog('option', 'buttons', {
                '<?php echo __('OK'); ?>': function () {
                    location = action;
                },
                '<?php echo __('Cancel'); ?>': function () {
                    $(this).dialog("close");
                }
            });
            $("#confirmDialog").dialog("open");
        });


        /**
         * 
         * Modal Confirm Dialog if the input is submit and has class confirmModal
         * @author  Sarawutt.b
         * @param   object theINPUT
         * @returns string HTML format               
         */
        $("input:submit.confirmModal,button:submit.confirmModal").click(function (theINPUT) {
            theINPUT.preventDefault();
            var title = ($(this).attr("data-confirm-title") || $(this).attr("btitle")) || _modalTitle;
            var theFORM = $(theINPUT.target).closest("form");
            var theMESSAGE = ($(this).attr("data-confirm-message") || $(this).attr("rel")) || _modalConfirmMessage;
            if (!theFORM.valid()) {
                return false;
            } else {
                $(".modal-title").text(title);
                confirmModal(theMESSAGE, function (result) {
                    if (result == true) {
                        theFORM.trigger('submit');
                        return true;
                    } else {
                        return false;
                    }
                });
            }
        });

        /**
         * 
         * Modal Confirm Dialog if the input is a link and has class confirmModal
         * @author  Sarawutt.b
         * @param   object link
         * @returns string HTML format               
         */
        $("a.confirmModal").click(function (link) {
            link.preventDefault();
            var title = ($(this).attr("data-confirm-title") || $(this).attr('btitle')) || _modalTitle;
            var theHREF = $(this).attr("href");
            var theMESSAGE = ($(this).attr("data-confirm-message") || $(this).attr("rel")) || _modalConfirmMessage;
            $(".modal-title").text(title);
            confirmModal(theMESSAGE, function (result) {
                if (result == true) {
                    window.location.href = theHREF;
                    return true;
                } else {
                    return false;
                }
            });
        });

        /**
         * 
         * Modal Confirm Dialog if the input is button and has class confirmModal
         * @author  Sarawutt.b
         * @param   object theINPUT
         * @returns string HTML format               
         */
        $("input[type='button'].confirmModal,button[type='button'].confirmModal").click(function (theINPUT) {
            theINPUT.preventDefault();
            var title = ($(this).attr("data-confirm-title") || $(this).attr('btitle')) || _modalTitle;
            var theFORM = $(theINPUT.target).closest("form");
            var theMESSAGE = ($(this).attr("data-confirm-message") || $(this).attr("rel")) || _modalConfirmMessage;
            var action = $(this).attr('action');
            $(".modal-title").text(title);
            confirmModal(theMESSAGE, function (result) {
                if (result == true) {
                    location = action;
                    return true;
                } else {
                    return false;
                }
            });
        });


    }); //End Jquery Syntax

    /**
     * 
     * Function Modal confirm display Modal dialog Confirmation
     * @author   Sarawutt.b
     * @param   {type} confirmMsg as string of confirm message
     * @param   {type} object function
     * @returns boolean true if confirm and false in otherwise
     */
    function confirmModal(confirmMsg, callback) {
        if ($.trim($(".modal-title").text()) == '') {
            $(".modal-title").text(_modalTitle);
        }
        $('#loading-indicator').hide();
        confirmMsg = confirmMsg || '<?php echo __('Please confirm for your process action.'); ?>';
        callback = callback || callback();
        
        console.log(callback);
        $("#largeModalBodyText,#ConfirmModalBodyText").text(confirmMsg);
        $("#ConfirmModal").modal({show: true, backdrop: false, keyboard: false});
        $("#btnConfirm").click(function () {
            $("#ConfirmModal").modal({show: false});
            if (callback) {
                callback(true);
            }
        });
        $("#btnClose").click(function () {
            $("#ConfirmModal").modal({show: false});
            if (callback) {
                callback(false);
            }
        });
    }
    window.confirm = confirmModal;

    /**
     * 
     * Function make HTML simle select to chosen style
     * @author  Sarawutt.b
     * @returns output in select element style
     */
    function makeChosen() {
        var config = {
            '.chosen-select': {},
            '.chosen-select-deselect': {allow_single_deselect: true},
            '.chosen-select-no-single': {disable_search_threshold: 10},
            '.chosen-select-no-results': {no_results_text: '<?php echo __('Oops, nothing found!'); ?>'},
            '.chosen-select-width': {width: "95%"}
        }

        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    }

    /**
     * Function make notification bueaties flash top display
     * @author  Sarawutt.b
     * @param   string title of flash name 
     * @param   string msg of display notification
     * @param   string mode (success | error | warning)
     * @returns void
     */
    function buildTopNotification(title, msg, mode) {
        return '<div class="box box-' + mode + '"><div class="box-header with-border"><h3 class="box-title">' + title + '</h3></div><div class="box-body">' + msg + '</div></div>';
    }

    /**
     * Function make notification bueaties flash top display
     * @author  Sarawutt.b
     * @param   string msg of display notification
     * @param   string mode (success | error | warning)
     * @returns void
     */
    function buildTopAlertMessage(msg, mode) {
        return '<div class="alert alert-' + mode + '"><button type="button"class="close"data-dismiss="alert">&times;</button><span id="info-message">' + msg + '</span></div>';
    }

    /**
     * Function make notification bueaties dialog as center display
     * @author  Sarawutt.b
     * @param   string message of display notification
     * @returns void
     */
    function AppMessage(message) {
        $("#appMessage").html(message);
        $("#appMessage").dialog("open");
    }

    /**
     * Function make notification bueaties dialog as center display
     * @author  Sarawutt.b
     * @param   string confirmMsg of display notification with modal body section
     * @param   string modalTitle of display notification with modal title section
     * @returns void and display alert modal style
     */
    function modalMessage(confirmMsg, modalTitle) {
        $('#loading-indicator').hide();
        modalTitle = modalTitle || _modalMessageTitle;
        confirmMsg = confirmMsg || '<?php echo __('Your process running to the statis.'); ?>';
        $(".modal-title").text(modalTitle);
        $("#largeModalBodyText,#ConfirmModalBodyText").text(confirmMsg);
        $("#largeModal").modal('show');
    }

    /**
     * Function make notification bueaties flash top display
     * @author  Sarawutt.b
     * @param   string message of display notification
     * @returns void
     */
    function TopAppMessage(message) {
        var appMessage = '<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" style="margin: 0 0 20px 0; padding: 0 .7em;"> <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>Appication Message : </strong> ' + message + '</p></div></div>';
        $("#confirmDialog").html(appMessage);
    }

    /**
     * Function make notification bueaties flash top display(Error style)
     * @author  Sarawutt.b
     * @param   string message of display notification
     * @returns void
     */
    function TopAppError(message) {
        var errorMessage = '<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="margin: 0 0 20px 0; padding: 0 .7em;"> <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>ERROR Message : </strong> ' + message + '</p></div></div>';
        $("#confirmDialog").html(errorMessage);
    }

    /**
     * Function ajax get District from master data 
     * @author  Sarawutt.b
     * @param   parameter with dinamic province_id jQuery dinamic selecter get params
     * @since   2016/04/26 11:16:22
     * @returns display district filter by province
     */
    function getDistrict() {
        $.post("/Utils/findDistrict/" + $("#ProvinceId").val(), function (data) {
            $("#DistrictId").html(data);
            getSubDistrict();
        });
    }

    /**
     * Function ajax get Sub-district from master data 
     * @author  Sarawutt.b
     * @param   parameter with dinamic District jQuery dinamic selecter get params
     * @since   2016/04/26 11:16:22
     * @returns display district filter by district
     */
    function getSubDistrict() {
        $.post("/Utils/findSubDistrict/" + $("#DistrictId").val(), function (data) {
            $("#SubDistrictId").html(data);
            getZipcode();
        });
    }

    /**
     * Function ajax get zipcode from master data 
     * @author  Sarawutt.b
     * @param   parameter with dinamic Sub-district jQuery dinamic selecter get params
     * @since   2016/04/26 11:16:22
     * @returns display district filter by Sub-district
     */
    function getZipcode() {
        $.post("/Utils/findZipcode/" + $("#SubDistrictId").val(), function (data) {
            $("#zipCode").val(data);
            updateChosen();
        });
    }

    /**
     * Function find options list of system action with selected system controller id 
     * @author  Sarawutt.b
     * @since   2016/04/26 11:16:22
     * @returns display system action filter by controller id
     */
    function getSystemActionListBySystemControllerId() {
        $.post("/Utils/findActionByControllerId/" + $("#sysControllerId").val(), function (data) {
            $("#SysActionId").html(data).prop('disabled', false);
            updateChosen();
        });
    }

    /**
     * Function update selecte list build to chosen after re created with ajax content 
     * @author  Sarawutt.b
     * @since   2016/04/26 11:16:22
     * @returns display district filter by Sub-district
     */
    function updateChosen() {
        $(".chosen-select").trigger("chosen:updated");
    }

    /**
     * Number.prototype.format(n, x)
     * 
     * @param integer n: length of decimal
     * @param integer x: length of sections
     */
    Number.prototype.format = function (n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };


//    Number.prototype.formatMoney = function (c, d, t) {
//        var n = this,
//                c = isNaN(c = Math.abs(c)) ? 2 : c,
//                d = d == undefined ? "." : d,
//                t = t == undefined ? "," : t,
//                s = n < 0 && n.toFixed(2) != '-0.00' ? "-" : "",
//                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
//                //i = Number(n = Math.abs(+n || 0).toFixed(c)) + "",
//                j = (j = i.length) > 3 ? j % 3 : 0;
//        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
//    };

    /**
     * Converts number into currency format
     * @param {number} number   Number that should be converted.
     * @param {string} [decimalSeparator]    Decimal separator, defaults to '.'.
     * @param {string} [thousandsSeparator]    Thousands separator, defaults to ','.
     * @param {int} [nDecimalDigits]    Number of decimal digits, defaults to `2`.
     * @return {string} Formatted string (e.g. numberToCurrency(12345.67) returns '12,345.67')
     */
    function numberToCurrency(number, decimalSeparator, thousandsSeparator, nDecimalDigits) {
        //default values
        decimalSeparator = decimalSeparator || '.';
        thousandsSeparator = thousandsSeparator || ',';
        nDecimalDigits = nDecimalDigits == null ? 2 : nDecimalDigits;

        var fixed = number.toFixed(nDecimalDigits), //limit/add decimal digits
                parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed); //separate begin [$1], middle [$2] and decimal digits [$4]

        if (parts) { //number >= 1000 || number <= -1000
            return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');
        } else {
            return fixed.replace('.', decimalSeparator);
        }
    }


    /**
     * Function make notification bueaties dialog as center display
     * @author  Sarawutt.b
     * @param   string confirmMsg of display notification with modal body section
     * @param   string modalTitle of display notification with modal title section
     * @returns void and display alert modal style
     */
    function AppMessage(confirmMsg, modalTitle) {
        modalMessage(confirmMsg, modalTitle);
    }

    /**
     * 
     * Function make for notification infomation
     * @author  sarawut.b
     * @param   {type} msg as a string of message
     * @returns  void     
     * */
    function AppDefault(msg) {
        var msg = msg || '<?php echo __('Zicre default notification message'); ?>';
        $.notify(msg);
        return true;
    }

    /**
     * 
     * Function make for notification infomation
     * @author  sarawut.b
     * @param   {type} msg as a string of message
     * @returns  void     
     * */
    function AppInfo(msg) {
        var msg = msg || '<?php echo __('Zicre default notification message'); ?>';
        $.notify(msg, 'info');
        return true;
    }


    /**
     * 
     * Function make for notification infomation success mode
     * @author  sarawut.b
     * @param   {type} msg as a string of message
     * @returns  void     
     */
    function AppSuccess(msg) {
        var msg = msg || '<?php echo __('Process successfully'); ?>';
        $.notify(msg, 'success');
        return true;
    }

    /**
     * 
     * Function make for notification infomation
     * @author  sarawut.b
     * @param   {type} msg as a string of message
     * @returns  void     
     */
    function AppWarning(msg) {
        var msg = msg || '<?php echo __('Process warnige'); ?>';
        $.notify(msg, 'warning');
        return true;
    }

    /**
     * 
     * Function make for notification infomation danger mode
     * @author  sarawut.b
     * @param   {type} msg as a string of message
     * @returns  void     
     */
    function AppDanger(msg) {
        var msg = msg || '<?php echo __('Process ploblem'); ?>';
        $.notify(msg, 'danger');
        return true;
    }

    /**
     * 
     * Applintion core notification 
     * @author  sarawutt.b
     * @param   sender object
     * @param   handeler object
     * @param   string class of notification style
     * @returns void with render notification output to the screen
     */
    function appNoti(that, event, status) {
        event.preventDefault();
        var status = status || 'default';
        var dataNotiMessage = (typeof ($(that).attr('data-noti-message')) === 'undefined') ? '<?php echo __('Zicre default notification message'); ?>' : $(that).attr('data-noti-message');
        $.notify(dataNotiMessage, status);
    }



    /**
     * 
     * Application alert message show as a Flash notification style
     * @author  sarawutt.b
     * @param   string alertType as string of alert type posible value [success|warning|info|danger]
     * @param   string msg as string of alert message
     * @returns void
     */
    function appAlertMessage(alertType, msg) {
        $("#appMessage").append($("<div class='alert alert- " + alertType + " fade in' data-alert><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" + msg + "</div>"));
        $(".alert").delay(7000).fadeOut("slow", function () {
            $(this).remove();
        });
    }


    /**
     * 
     * Automatically closing for the application notification
     * Alert dialog on Flash alert status
     * @author  sarawutt.b
     */
    function fadeoutNotification() {
        $(".alert").delay(7000).fadeOut("slow", function () {
            $(this).remove();
        });
        return true;
    }
</script>
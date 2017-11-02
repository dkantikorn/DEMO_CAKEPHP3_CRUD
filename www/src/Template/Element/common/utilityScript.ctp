<script type="text/javascript">
/**
 * 
 * Application utility tuning script
 * @author  sarawutt.b
 * @since   2017/07/02
 */
    var _modalConfirmTitle = '<?php echo __('Are you sure process the action'); ?>';
    var _modalConfirmMessage = '<?php echo __('Are you sure process the action ?'); ?>';
    var _modalTitle = '<?php echo __('Application process status'); ?>';
    var _modalMessage = '<?php echo __('Application process successfully'); ?>';



/**
 * ===========================================================================================
 * Setup plugin initialize
 * ===========================================================================================
 */
    /**
     * 
     * Toastr Top modern notification configure and tunning
     * @author  sarawutt.b
     * @link    http://codeseven.github.io/toastr/demo.html
     * @git     https://github.com/CodeSeven/toastr
     */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
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

    //$('.container').infiniteScroll({
    //  // options
    //  path: '.pagination__next',
    //  append: '.post',
    //  history: false,
    //});
    $(function () {


/**
 * 
 * =====================================================================================
 * Confirm modal section
 * =====================================================================================
 */

        //index page has show delete button ask for confirm before delete
        //if actor click to confirm then delete data where condition correcly in the database
        $('.action-cancel,.action-delete-submit,.action-delete').removeAttr('onclick');
        $("a.action-delete").on('click', function () {
            $this = $(this);
            confirmModal('<?php echo __('Are you sure for delete ?'); ?>', function (result) {
                if (result == true) {
                    var url = $(location).attr('protocol') + '//' + $(location).attr('host') + $this.prev().attr('action');
                    
                    $.post(url, function (data, status) {
                        try {
                            var tmpJson = $.parseJSON(data);
                        } catch (error) {
                            var tmpJson = {message: $.trim($(data).filter('p').text()), class: 'success'};
                        }
                        
                        console.log(tmpJson);
                        console.log(status);
                        console.log(data);
                        
                        var msg = tmpJson.message || '<?php echo __('Successfully'); ?>';
                        if (status == 'success') {
                            if ($this.hasClass('btnGroupMenu')) {
                                $this.parent().parent().parent().parent().parent().remove();
                            } else {
                                $this.parent().parent().remove();
                            }
                            toastr.success(msg);
                            return true;
                        } else {
                            toastr.error(msg);
                            return false;
                        }
                        return;
                    });
                } else {
                    return false;
                }
            });
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
            var title = ($(this).attr("data-confirm-title") || $(this).attr("btitle")) || _modalConfirmTitle;
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
            var title = ($(this).attr("data-confirm-title") || $(this).attr('btitle')) || _modalConfirmTitle;
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
            var title = ($(this).attr("data-confirm-title") || $(this).attr('btitle')) || _modalConfirmTitle;
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


        //-------------------------------------------------------------------------------------------------------------------------
    });//End Jquery Syntax

/**
 * 
 * ----------------------------------------------------------------------------------------------------------------------------
 * Utility function
 * ----------------------------------------------------------------------------------------------------------------------------
 */

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
            $(".modal-title").text(_modalConfirmTitle);
        }
        $('#loading-indicator').hide();
        confirmMsg = confirmMsg || _modalConfirmMessage;
        callback = callback || callback();
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
</script>
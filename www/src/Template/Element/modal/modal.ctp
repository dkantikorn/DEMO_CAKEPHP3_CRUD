<!-- Modal -->
<div class="modal fade cart-modal" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title w-100" id="largeModalTitleLabel"><!-- the title for confirm modal --></h4>
            </div>


            <div class="modal-body">
                <p id="largeModalBodyText"><!-- text confirm message for the modal --></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal"><?php echo __('Close'); ?></button>
            </div>
            
        </div>
    </div>
</div>


<!-- Confirm bootstrap modal -->
<!-- Modal -->
<div class="modal fade cart-modal" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="ConfirmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title w-100" id="ConfirmModalTitleLabel"><!-- the title for confirm modal --></h4>
            </div>
            
            <div class="modal-body">
                <p id="ConfirmModalBodyText"><!-- text confirm message for the modal --></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" id="btnConfirm"><?php echo __('Confirm'); ?></button>
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" id="btnClose"><?php echo __('Close'); ?></button>
            </div>
        </div>
    </div>
</div>

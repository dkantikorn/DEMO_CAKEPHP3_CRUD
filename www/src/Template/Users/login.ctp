<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6 mt-4">

            <?php echo $this->Form->create(); ?>
            <div class="card">
                <div class="card-block">

                    <!--Header-->
                    <div class="form-header  purple darken-4">
                        <h3><i class="fa fa-lock"></i> Login:</h3>
                    </div>

                    <!--Body-->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="text" id="form2" class="form-control" name="username">
                        <label for="form2">Your email</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-lock prefix"></i>
                        <input type="password" id="form4" class="form-control" name="password">
                        <label for="form4">Your password</label>
                    </div>

                    <?php echo $this->Form->button(__('Login'), ['class' => 'btn-deep-purple waves-effect waves-light pull-right']); ?>
                </div>

                <!--Footer-->
                <div class="modal-footer">
                    <div class="options">
                        <p>Not a member? <a href="/Users/add"><?php echo __('Sign Up'); ?></a></p>
                        <p>Forgot <a href="/Users/forgotPassword"><?php echo __('Password ?'); ?></a></p>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>

        </div>
    </div>
</div>
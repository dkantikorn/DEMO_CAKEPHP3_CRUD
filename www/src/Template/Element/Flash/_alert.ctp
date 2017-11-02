<?php
    $class = isset($class) ? $class : 'alert-info';
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
    
    //debug($message);exit;
?>
<div class="alert <?php echo $class; ?> fade in">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message; ?>
</div><!-- /.alert alert-info -->
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script type="text/javascript">
    $(function(){
        toastr.error('<?php echo $message;?>');
    });
</script>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script type="text/javascript">
    $(function(){
        toastr.success('<?php echo $message;?>');
    });
</script>
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script type="text/javascript">
    $(function () {
        toastr.warning('<?php echo $message; ?>');
    });
</script>
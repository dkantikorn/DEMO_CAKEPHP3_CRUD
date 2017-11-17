<nav aria-label="...">
    <ul class="pagination pg-purple">
        <?php echo $this->Paginator->first('<< ' . __('first')); ?>
        <?php echo $this->Paginator->prev('< ' . __('previous')); ?>

        <?php echo $this->Paginator->numbers(); ?>

        <?php echo $this->Paginator->next(__('next') . ' >'); ?>
        <?php echo $this->Paginator->last(__('last') . ' >>'); ?>
    </ul>
    <p class="paginate-summary"><?php echo $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]); ?></p>
</nav>

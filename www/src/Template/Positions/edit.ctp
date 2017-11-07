<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Position $position
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions'); ?></li>
        <li><?php echo $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $position->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $position->id)]
            );
        ?></li>
        <li><?php echo $this->Html->link(__('List Positions'), ['action' => 'index']); ?></li>
    </ul>
</nav>
<div class="positions form large-9 medium-8 columns content">
    <?php echo $this->Form->create($position); ?>
    <fieldset>
        <legend><?php echo __('Edit Position'); ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('name_eng');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
            echo $this->Form->control('create_uid');
            echo $this->Form->control('update_uid');
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')); ?>
    <?php echo $this->Form->end(); ?>
</div>

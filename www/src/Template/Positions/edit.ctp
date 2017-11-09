<?php
/**
 * 
 * The template for edit page of positionsController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Position $position
 * @since   2017-11-09 05:02:32
 * @license Pakgon.Ltd
 */
?>
<div class="container">
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
</div>
<div class="container">
    <div class="positions form large-9 medium-8 columns content">
        <?php echo $this->Form->create($position); ?>
        <fieldset>
            <legend><?php echo __('Edit Position'); ?></legend>
                    <?php echo $this->Form->control('name'); ?>
                    <?php echo $this->Form->control('name_eng'); ?>
                    <?php echo $this->Form->control('description'); ?>
                    <?php echo $this->Form->control('status'); ?>
            </fieldset>
        <?php echo $this->Form->button(__('Submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<?php
/**
 * 
 * The template for add page of namePrefixesController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\NamePrefix $namePrefix
 * @since   2017-11-13 08:53:17
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
                <li><?php echo $this->Html->link(__('List Name Prefixes'), ['action' => 'index']); ?></li>
                <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?></li>
            </ul>
    </nav>
</div>
<div class="container">
    <div class="namePrefixes form large-9 medium-8 columns content">
        <?php echo $this->Form->create($namePrefix); ?>
        <fieldset>
            <legend><?php echo __('Add Name Prefix'); ?></legend>
                    <?php echo $this->Form->control('name'); ?>
                    <?php echo $this->Form->control('name_eng'); ?>
                    <?php echo $this->Form->control('long_name'); ?>
                    <?php echo $this->Form->control('status'); ?>
                    <?php echo $this->Form->control('order_no'); ?>
            </fieldset>
        <?php echo $this->Form->button(__('Submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

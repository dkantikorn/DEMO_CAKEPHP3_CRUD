<?php
/**
 * 
 * The template for add page of menusController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Menu $menu
 * @since   2017-11-17 11:54:49
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('List Menus'), ['action' => 'index']); ?></li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="menus form large-9 medium-8 columns content">
        <?php echo $this->Form->create($menu); ?>
        <fieldset>
            <legend><?php echo __('Add Menu'); ?></legend>
            <?php echo $this->Form->control('name'); ?>
            <?php echo $this->Form->control('name_eng'); ?>
            <?php echo $this->Form->control('glyphicon'); ?>
            <?php echo $this->Form->control('domain'); ?>
            <?php echo $this->Form->control('port'); ?>
            <?php echo $this->Form->control('sys_controller_id'); ?>
            <?php echo $this->Form->control('sys_action_id'); ?>
            <?php echo $this->Form->control('url'); ?>
            <?php echo $this->Form->control('order_display'); ?>
            <?php echo $this->Form->control('menu_parent_id'); ?>
            <?php echo $this->Form->control('child_no'); ?>
            <?php echo $this->Form->control('status'); ?>
            <?php echo $this->Form->control('badge'); ?>
            <?php echo $this->Form->control('page_level'); ?>
        </fieldset>
        <?php echo $this->Form->button(__('Submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

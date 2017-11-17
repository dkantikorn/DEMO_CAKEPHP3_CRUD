<?php
/**
 * 
 * The template for edit page of rolesController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Role $role
 * @since   2017-11-17 11:56:28
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php
                echo $this->Form->postLink(
                        __('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]
                );
                ?></li>
            <li><?php echo $this->Html->link(__('List Roles'), ['action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?></li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="roles form large-9 medium-8 columns content">
        <?php echo $this->Form->create($role); ?>
        <fieldset>
            <legend><?php echo __('Edit Role'); ?></legend>
            <?php echo $this->Form->control('name'); ?>
            <?php echo $this->Form->control('name_eng'); ?>
            <?php echo $this->Form->control('description'); ?>
            <?php echo $this->Form->control('status'); ?>
        </fieldset>
        <?php echo $this->Form->button(__('Submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

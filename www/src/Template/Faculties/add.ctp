<?php
/**
 * 
 * The template for add page of facultiesController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Faculty $faculty
 * @since   2017-11-17 11:53:42
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('List Faculties'), ['action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']); ?></li>
            <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?></li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="faculties form large-9 medium-8 columns content">
        <?php echo $this->Form->create($faculty); ?>
        <fieldset>
            <legend><?php echo __('Add Faculty'); ?></legend>
            <?php echo $this->Form->control('faculty_code'); ?>
            <?php echo $this->Form->control('name'); ?>
            <?php echo $this->Form->control('detail'); ?>
            <?php echo $this->Form->control('status'); ?>
        </fieldset>
        <?php echo $this->Form->button(__('Submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

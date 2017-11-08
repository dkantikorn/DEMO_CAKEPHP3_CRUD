<?php
/**
 * 
 * The template for view page of positionsController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Position $position
 * @since   2017-11-08 05:01:28
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('Edit Position'), ['action' => 'edit', $position->id]); ?> </li>
            <li><?php echo $this->Form->postLink(__('Delete Position'), ['action' => 'delete', $position->id], ['confirm' => __('Are you sure you want to delete # {0}?', $position->id)]); ?> </li>
            <li><?php echo $this->Html->link(__('List Positions'), ['action' => 'index']); ?> </li>
            <li><?php echo $this->Html->link(__('New Position'), ['action' => 'add']); ?> </li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="positions view large-9 medium-8 columns content">
        <h3><?php echo h($position->name); ?></h3>
        <table class="vertical-table table">
            <tr>
                <th scope="row"><?php echo __('Name'); ?></th>
                <td><?php echo h($position->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Name Eng'); ?></th>
                <td><?php echo h($position->name_eng); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Description'); ?></th>
                <td><?php echo h($position->description); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Status'); ?></th>
                <td><?php echo h($position->status); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Id'); ?></th>
                <td><?php echo $this->Number->format($position->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Create Uid'); ?></th>
                <td><?php echo $this->Number->format($position->create_uid); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Update Uid'); ?></th>
                <td><?php echo $this->Number->format($position->update_uid); ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?php echo h($position->created); ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?php echo h($position->modified); ?></td>
            </tr>
        </table>
    </div>
</div>

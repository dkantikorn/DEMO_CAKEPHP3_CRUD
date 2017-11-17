<?php
/**
 * 
 * The template for index page of rolesController. This page show for short roles informations.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 * @since   2017-11-17 11:56:28
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('New Role'), ['action' => 'add']); ?></li>
            <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?></li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="roles index large-9 medium-8 columns content table-responsive">
        <h3><?php echo __('Roles'); ?></h3>
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?php echo $this->Paginator->sort('id'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('name'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('name_eng'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('description'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('status'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('create_uid'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('update_uid'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('created'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th scope="col" class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?php echo $this->Number->format($role->id); ?></td>
                        <td><?php echo h($role->name); ?></td>
                        <td><?php echo h($role->name_eng); ?></td>
                        <td><?php echo h($role->description); ?></td>
                        <td><?php echo h($role->status); ?></td>
                        <td><?php echo $this->Number->format($role->create_uid); ?></td>
                        <td><?php echo $this->Number->format($role->update_uid); ?></td>
                        <td><?php echo h($role->created); ?></td>
                        <td><?php echo h($role->modified); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), ['action' => 'view', $role->id]); ?>
                            <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]); ?>
                            <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('common/paginator'); ?>
    </div>
</div>

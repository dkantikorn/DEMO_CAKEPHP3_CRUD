<?php
/**
 * 
 * The template for index page of facultiesController. This page show for short faculties informations.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Faculty[]|\Cake\Collection\CollectionInterface $faculties
 * @since   2017-11-17 11:53:42
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('New Faculty'), ['action' => 'add']); ?></li>
            <li><?php echo $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']); ?></li>
            <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?></li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="faculties index large-9 medium-8 columns content table-responsive">
        <h3><?php echo __('Faculties'); ?></h3>
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?php echo $this->Paginator->sort('id'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('faculty_code'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('name'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('detail'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('status'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('created'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th scope="col" class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faculties as $faculty): ?>
                    <tr>
                        <td><?php echo $this->Number->format($faculty->id); ?></td>
                        <td><?php echo h($faculty->faculty_code); ?></td>
                        <td><?php echo h($faculty->name); ?></td>
                        <td><?php echo h($faculty->detail); ?></td>
                        <td><?php echo h($faculty->status); ?></td>
                        <td><?php echo h($faculty->created); ?></td>
                        <td><?php echo h($faculty->modified); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), ['action' => 'view', $faculty->id]); ?>
                            <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $faculty->id]); ?>
                            <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $faculty->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faculty->id)]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('common/paginator'); ?>
    </div>
</div>

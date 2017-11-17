<?php
/**
 * 
 * The template for index page of positionsController. This page show for short positions informations.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Position[]|\Cake\Collection\CollectionInterface $positions
 * @since   2017-11-09 05:07:22
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('New Position'), ['action' => 'add']); ?></li>
            </ul>
    </nav>
</div>
<div class="container">
    <div class="positions index large-9 medium-8 columns content table-responsive">
        <h3><?php echo __('Positions'); ?></h3>
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
                <?php foreach ($positions as $position): ?>
                <tr>
                        <td><?php echo $this->Number->format($position->id); ?></td>
                        <td><?php echo h($position->name); ?></td>
                        <td><?php echo h($position->name_eng); ?></td>
                        <td><?php echo h($position->description); ?></td>
                        <td><?php echo h($position->status); ?></td>
                        <td><?php echo $this->Number->format($position->create_uid); ?></td>
                        <td><?php echo $this->Number->format($position->update_uid); ?></td>
                        <td><?php echo h($position->created); ?></td>
                        <td><?php echo h($position->modified); ?></td>
                        <td class="actions">
                        <?php echo $this->Html->link(__('View'), ['action' => 'view', $position->id]); ?>
                        <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $position->id]); ?>
                        <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $position->id], ['confirm' => __('Are you sure you want to delete # {0}?', $position->id)]); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('common/paginator');?>
    </div>
</div>

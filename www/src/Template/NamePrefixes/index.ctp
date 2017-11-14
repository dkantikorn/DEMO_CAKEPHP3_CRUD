<?php
/**
 * 
 * The template for index page of namePrefixesController. This page show for short namePrefixes informations.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\NamePrefix[]|\Cake\Collection\CollectionInterface $namePrefixes
 * @since   2017-11-13 08:53:17
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('New Name Prefix'), ['action' => 'add']); ?></li>
                <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?></li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?></li>
            </ul>
    </nav>
</div>
<div class="container">
    <div class="namePrefixes index large-9 medium-8 columns content table-responsive">
        <h3><?php echo __('Name Prefixes'); ?></h3>
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                        <th scope="col"><?php echo $this->Paginator->sort('id'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('name'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('name_eng'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('long_name'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('status'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('create_uid'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('update_uid'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('created'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('modified'); ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('order_no'); ?></th>
                        <th scope="col" class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($namePrefixes as $namePrefix): ?>
                <tr>
                        <td><?php echo $this->Number->format($namePrefix->id); ?></td>
                        <td><?php echo h($namePrefix->name); ?></td>
                        <td><?php echo h($namePrefix->name_eng); ?></td>
                        <td><?php echo h($namePrefix->long_name); ?></td>
                        <td><?php echo h($namePrefix->status); ?></td>
                        <td><?php echo $this->Number->format($namePrefix->create_uid); ?></td>
                        <td><?php echo $this->Number->format($namePrefix->update_uid); ?></td>
                        <td><?php echo h($namePrefix->created); ?></td>
                        <td><?php echo h($namePrefix->modified); ?></td>
                        <td><?php echo $this->Number->format($namePrefix->order_no); ?></td>
                        <td class="actions">
                        <?php echo $this->Html->link(__('View'), ['action' => 'view', $namePrefix->id]); ?>
                        <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $namePrefix->id]); ?>
                        <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $namePrefix->id], ['confirm' => __('Are you sure you want to delete # {0}?', $namePrefix->id)]); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?php echo $this->Paginator->first('<< ' . __('first')); ?>
                <?php echo $this->Paginator->prev('< ' . __('previous')); ?>
                <?php echo $this->Paginator->numbers(); ?>
                <?php echo $this->Paginator->next(__('next') . ' >'); ?>
                <?php echo $this->Paginator->last(__('last') . ' >>'); ?>
            </ul>
            <p><?php echo $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]); ?></p>
        </div>
    </div>
</div>

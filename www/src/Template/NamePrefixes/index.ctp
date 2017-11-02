<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NamePrefix[]|\Cake\Collection\CollectionInterface $namePrefixes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Name Prefix'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="namePrefixes index large-9 medium-8 columns content">
    <h3><?= __('Name Prefixes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_eng') ?></th>
                <th scope="col"><?= $this->Paginator->sort('long_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_no') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($namePrefixes as $namePrefix): ?>
            <tr>
                <td><?= $this->Number->format($namePrefix->id) ?></td>
                <td><?= h($namePrefix->name) ?></td>
                <td><?= h($namePrefix->name_eng) ?></td>
                <td><?= h($namePrefix->long_name) ?></td>
                <td><?= h($namePrefix->status) ?></td>
                <td><?= $this->Number->format($namePrefix->create_uid) ?></td>
                <td><?= $this->Number->format($namePrefix->update_uid) ?></td>
                <td><?= h($namePrefix->created) ?></td>
                <td><?= h($namePrefix->modified) ?></td>
                <td><?= $this->Number->format($namePrefix->order_no) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $namePrefix->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $namePrefix->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $namePrefix->id], ['confirm' => __('Are you sure you want to delete # {0}?', $namePrefix->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu[]|\Cake\Collection\CollectionInterface $menus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus index large-9 medium-8 columns content">
    <h3><?= __('Menus') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_eng') ?></th>
                <th scope="col"><?= $this->Paginator->sort('glyphicon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('domain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('port') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sys_controller_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sys_action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_display') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('child_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_uid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('page_level') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= $this->Number->format($menu->id) ?></td>
                <td><?= h($menu->name) ?></td>
                <td><?= h($menu->name_eng) ?></td>
                <td><?= h($menu->glyphicon) ?></td>
                <td><?= h($menu->domain) ?></td>
                <td><?= h($menu->port) ?></td>
                <td><?= $this->Number->format($menu->sys_controller_id) ?></td>
                <td><?= $this->Number->format($menu->sys_action_id) ?></td>
                <td><?= h($menu->url) ?></td>
                <td><?= $this->Number->format($menu->order_display) ?></td>
                <td><?= $this->Number->format($menu->menu_parent_id) ?></td>
                <td><?= $this->Number->format($menu->child_no) ?></td>
                <td><?= h($menu->status) ?></td>
                <td><?= $this->Number->format($menu->create_uid) ?></td>
                <td><?= $this->Number->format($menu->update_uid) ?></td>
                <td><?= h($menu->created) ?></td>
                <td><?= h($menu->modified) ?></td>
                <td><?= $this->Number->format($menu->page_level) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $menu->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
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

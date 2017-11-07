<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<div class="container">
    <div class="row">
        <div class="roles index large-9 medium-8 columns content table-responsive">
            <h3><?= __('Roles') ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name_eng') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('create_uid') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('update_uid') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?= $this->Number->format($role->id) ?></td>
                            <td><?= h($role->name) ?></td>
                            <td><?= h($role->name_eng) ?></td>
                            <td><?= h($role->description) ?></td>
                            <td><?= h($role->status) ?></td>
                            <td><?= $this->Number->format($role->create_uid) ?></td>
                            <td><?= $this->Number->format($role->update_uid) ?></td>
                            <td><?= h($role->created) ?></td>
                            <td><?= h($role->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link($this->Html->icon('search') . ' ' . __('View'), ['action' => 'view', $role->id], ['class' => 'btn btn-sm btn-info btn-rounded waves-effect waves-light', 'escape' => false]) ?>
                                <?= $this->Html->link($this->Html->icon('pencil') . ' ' . __('Edit'), ['action' => 'edit', $role->id], array('class' => 'btn btn-sm btn-warning btn-rounded waves-effect waves-light', 'escape' => false)) ?>
                                <?= $this->Form->postLink($this->Html->icon('trash') . ' ' . __('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'btn btn-sm btn-danger btn-rounded waves-effect waves-light confirmModal action-delete', 'escape' => false]) ?>
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
    </div>
</div>

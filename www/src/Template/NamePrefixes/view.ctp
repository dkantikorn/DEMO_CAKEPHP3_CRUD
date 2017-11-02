<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NamePrefix $namePrefix
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Name Prefix'), ['action' => 'edit', $namePrefix->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Name Prefix'), ['action' => 'delete', $namePrefix->id], ['confirm' => __('Are you sure you want to delete # {0}?', $namePrefix->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Name Prefixes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Name Prefix'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="namePrefixes view large-9 medium-8 columns content">
    <h3><?= h($namePrefix->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($namePrefix->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Eng') ?></th>
            <td><?= h($namePrefix->name_eng) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Long Name') ?></th>
            <td><?= h($namePrefix->long_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($namePrefix->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($namePrefix->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Uid') ?></th>
            <td><?= $this->Number->format($namePrefix->create_uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Uid') ?></th>
            <td><?= $this->Number->format($namePrefix->update_uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order No') ?></th>
            <td><?= $this->Number->format($namePrefix->order_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($namePrefix->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($namePrefix->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($namePrefix->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Faculty Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Ref Code') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Name Prefix Id') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Office Phone') ?></th>
                <th scope="col"><?= __('Mobile Phone') ?></th>
                <th scope="col"><?= __('Birth Date') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Moo') ?></th>
                <th scope="col"><?= __('Road') ?></th>
                <th scope="col"><?= __('Sub District') ?></th>
                <th scope="col"><?= __('District') ?></th>
                <th scope="col"><?= __('Province') ?></th>
                <th scope="col"><?= __('Zipcode') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Picture Path') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($namePrefix->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->faculty_id) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->ref_code) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->name_prefix_id) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->office_phone) ?></td>
                <td><?= h($users->mobile_phone) ?></td>
                <td><?= h($users->birth_date) ?></td>
                <td><?= h($users->address) ?></td>
                <td><?= h($users->moo) ?></td>
                <td><?= h($users->road) ?></td>
                <td><?= h($users->sub_district) ?></td>
                <td><?= h($users->district) ?></td>
                <td><?= h($users->province) ?></td>
                <td><?= h($users->zipcode) ?></td>
                <td><?= h($users->status) ?></td>
                <td><?= h($users->picture_path) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

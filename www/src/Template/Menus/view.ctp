<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($menu->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Eng') ?></th>
            <td><?= h($menu->name_eng) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Glyphicon') ?></th>
            <td><?= h($menu->glyphicon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Domain') ?></th>
            <td><?= h($menu->domain) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Port') ?></th>
            <td><?= h($menu->port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($menu->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($menu->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sys Controller Id') ?></th>
            <td><?= $this->Number->format($menu->sys_controller_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sys Action Id') ?></th>
            <td><?= $this->Number->format($menu->sys_action_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Display') ?></th>
            <td><?= $this->Number->format($menu->order_display) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu Parent Id') ?></th>
            <td><?= $this->Number->format($menu->menu_parent_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Child No') ?></th>
            <td><?= $this->Number->format($menu->child_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create Uid') ?></th>
            <td><?= $this->Number->format($menu->create_uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Update Uid') ?></th>
            <td><?= $this->Number->format($menu->update_uid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Page Level') ?></th>
            <td><?= $this->Number->format($menu->page_level) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($menu->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($menu->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Badge') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->badge)); ?>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Add Menu') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('name_eng');
            echo $this->Form->control('glyphicon');
            echo $this->Form->control('domain');
            echo $this->Form->control('port');
            echo $this->Form->control('sys_controller_id');
            echo $this->Form->control('sys_action_id');
            echo $this->Form->control('url');
            echo $this->Form->control('order_display');
            echo $this->Form->control('menu_parent_id');
            echo $this->Form->control('child_no');
            echo $this->Form->control('status');
            echo $this->Form->control('create_uid');
            echo $this->Form->control('update_uid');
            echo $this->Form->control('badge');
            echo $this->Form->control('page_level');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

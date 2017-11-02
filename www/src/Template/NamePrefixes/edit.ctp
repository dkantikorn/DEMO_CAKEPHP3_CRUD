<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NamePrefix $namePrefix
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $namePrefix->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $namePrefix->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Name Prefixes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="namePrefixes form large-9 medium-8 columns content">
    <?= $this->Form->create($namePrefix) ?>
    <fieldset>
        <legend><?= __('Edit Name Prefix') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('name_eng');
            echo $this->Form->control('long_name');
            echo $this->Form->control('status');
            echo $this->Form->control('create_uid');
            echo $this->Form->control('update_uid');
            echo $this->Form->control('order_no');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

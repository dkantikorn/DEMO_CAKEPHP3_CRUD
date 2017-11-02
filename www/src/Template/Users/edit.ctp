<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Faculties'), ['controller' => 'Faculties', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Faculty'), ['controller' => 'Faculties', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Name Prefixes'), ['controller' => 'NamePrefixes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Name Prefix'), ['controller' => 'NamePrefixes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('faculty_id', ['options' => $faculties, 'empty' => true]);
            echo $this->Form->control('role_id', ['options' => $roles, 'empty' => true]);
            echo $this->Form->control('ref_code');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('name_prefix_id', ['options' => $namePrefixes]);
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('office_phone');
            echo $this->Form->control('mobile_phone');
            echo $this->Form->control('birth_date', ['empty' => true]);
            echo $this->Form->control('address');
            echo $this->Form->control('moo');
            echo $this->Form->control('road');
            echo $this->Form->control('sub_district');
            echo $this->Form->control('district');
            echo $this->Form->control('province');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('status');
            echo $this->Form->control('picture_path');
            echo $this->Form->control('courses._ids', ['options' => $courses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

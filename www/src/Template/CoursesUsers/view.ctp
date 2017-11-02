<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CoursesUser $coursesUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Courses User'), ['action' => 'edit', $coursesUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Courses User'), ['action' => 'delete', $coursesUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coursesUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Courses Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Courses User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coursesUsers view large-9 medium-8 columns content">
    <h3><?= h($coursesUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $coursesUser->has('user') ? $this->Html->link($coursesUser->user->id, ['controller' => 'Users', 'action' => 'view', $coursesUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course') ?></th>
            <td><?= $coursesUser->has('course') ? $this->Html->link($coursesUser->course->name, ['controller' => 'Courses', 'action' => 'view', $coursesUser->course->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($coursesUser->grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($coursesUser->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($coursesUser->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Days Attended') ?></th>
            <td><?= $this->Number->format($coursesUser->days_attended) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($coursesUser->score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($coursesUser->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($coursesUser->modified) ?></td>
        </tr>
    </table>
</div>

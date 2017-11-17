<?php
/**
 * 
 * The template for view page of facultiesController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Faculty $faculty
 * @since   2017-11-17 11:53:42
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('Edit Faculty'), ['action' => 'edit', $faculty->id]); ?> </li>
            <li><?php echo $this->Form->postLink(__('Delete Faculty'), ['action' => 'delete', $faculty->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faculty->id)]); ?> </li>
            <li><?php echo $this->Html->link(__('List Faculties'), ['action' => 'index']); ?> </li>
            <li><?php echo $this->Html->link(__('New Faculty'), ['action' => 'add']); ?> </li>
            <li><?php echo $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']); ?> </li>
            <li><?php echo $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']); ?> </li>
            <li><?php echo $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']); ?> </li>
            <li><?php echo $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']); ?> </li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="faculties view large-9 medium-8 columns content">
        <h3><?php echo h($faculty->name); ?></h3>
        <table class="vertical-table table">
            <tr>
                <th scope="row"><?php echo __('Faculty Code'); ?></th>
                <td><?php echo h($faculty->faculty_code); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Name'); ?></th>
                <td><?php echo h($faculty->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Detail'); ?></th>
                <td><?php echo h($faculty->detail); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Status'); ?></th>
                <td><?php echo h($faculty->status); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Id'); ?></th>
                <td><?php echo $this->Number->format($faculty->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Created'); ?></th>
                <td><?php echo h($faculty->created); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Modified'); ?></th>
                <td><?php echo h($faculty->modified); ?></td>
            </tr>
        </table>
        <div class="related">
            <h4><?php echo __('Related Courses'); ?></h4>
            <?php if (!empty($faculty->courses)): ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?php echo __('Id'); ?></th>
                        <th scope="col"><?php echo __('Faculty Id'); ?></th>
                        <th scope="col"><?php echo __('Course Code'); ?></th>
                        <th scope="col"><?php echo __('Name'); ?></th>
                        <th scope="col"><?php echo __('Credit'); ?></th>
                        <th scope="col"><?php echo __('Price'); ?></th>
                        <th scope="col"><?php echo __('Detail'); ?></th>
                        <th scope="col"><?php echo __('Status'); ?></th>
                        <th scope="col"><?php echo __('Created'); ?></th>
                        <th scope="col"><?php echo __('Modified'); ?></th>
                        <th scope="col" class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php foreach ($faculty->courses as $courses): ?>
                        <tr>
                            <td><?php echo h($courses->id); ?></td>
                            <td><?php echo h($courses->faculty_id); ?></td>
                            <td><?php echo h($courses->course_code); ?></td>
                            <td><?php echo h($courses->name); ?></td>
                            <td><?php echo h($courses->credit); ?></td>
                            <td><?php echo h($courses->price); ?></td>
                            <td><?php echo h($courses->detail); ?></td>
                            <td><?php echo h($courses->status); ?></td>
                            <td><?php echo h($courses->created); ?></td>
                            <td><?php echo h($courses->modified); ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('View'), ['controller' => 'Courses', 'action' => 'view', $courses->id]); ?>
                                <?php echo $this->Html->link(__('Edit'), ['controller' => 'Courses', 'action' => 'edit', $courses->id]); ?>
                                <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Courses', 'action' => 'delete', $courses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courses->id)]); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?php echo __('Related Users'); ?></h4>
            <?php if (!empty($faculty->users)): ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?php echo __('Id'); ?></th>
                        <th scope="col"><?php echo __('Faculty Id'); ?></th>
                        <th scope="col"><?php echo __('Role Id'); ?></th>
                        <th scope="col"><?php echo __('Ref Code'); ?></th>
                        <th scope="col"><?php echo __('Username'); ?></th>
                        <th scope="col"><?php echo __('Password'); ?></th>
                        <th scope="col"><?php echo __('Name Prefix Id'); ?></th>
                        <th scope="col"><?php echo __('First Name'); ?></th>
                        <th scope="col"><?php echo __('Last Name'); ?></th>
                        <th scope="col"><?php echo __('Email'); ?></th>
                        <th scope="col"><?php echo __('Office Phone'); ?></th>
                        <th scope="col"><?php echo __('Mobile Phone'); ?></th>
                        <th scope="col"><?php echo __('Birth Date'); ?></th>
                        <th scope="col"><?php echo __('Address'); ?></th>
                        <th scope="col"><?php echo __('Moo'); ?></th>
                        <th scope="col"><?php echo __('Road'); ?></th>
                        <th scope="col"><?php echo __('Sub District'); ?></th>
                        <th scope="col"><?php echo __('District'); ?></th>
                        <th scope="col"><?php echo __('Province'); ?></th>
                        <th scope="col"><?php echo __('Zipcode'); ?></th>
                        <th scope="col"><?php echo __('Status'); ?></th>
                        <th scope="col"><?php echo __('Picture Path'); ?></th>
                        <th scope="col"><?php echo __('Created'); ?></th>
                        <th scope="col"><?php echo __('Modified'); ?></th>
                        <th scope="col" class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <?php foreach ($faculty->users as $users): ?>
                        <tr>
                            <td><?php echo h($users->id); ?></td>
                            <td><?php echo h($users->faculty_id); ?></td>
                            <td><?php echo h($users->role_id); ?></td>
                            <td><?php echo h($users->ref_code); ?></td>
                            <td><?php echo h($users->username); ?></td>
                            <td><?php echo h($users->password); ?></td>
                            <td><?php echo h($users->name_prefix_id); ?></td>
                            <td><?php echo h($users->first_name); ?></td>
                            <td><?php echo h($users->last_name); ?></td>
                            <td><?php echo h($users->email); ?></td>
                            <td><?php echo h($users->office_phone); ?></td>
                            <td><?php echo h($users->mobile_phone); ?></td>
                            <td><?php echo h($users->birth_date); ?></td>
                            <td><?php echo h($users->address); ?></td>
                            <td><?php echo h($users->moo); ?></td>
                            <td><?php echo h($users->road); ?></td>
                            <td><?php echo h($users->sub_district); ?></td>
                            <td><?php echo h($users->district); ?></td>
                            <td><?php echo h($users->province); ?></td>
                            <td><?php echo h($users->zipcode); ?></td>
                            <td><?php echo h($users->status); ?></td>
                            <td><?php echo h($users->picture_path); ?></td>
                            <td><?php echo h($users->created); ?></td>
                            <td><?php echo h($users->modified); ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]); ?>
                                <?php echo $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]); ?>
                                <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="users view large-9 medium-8 columns content">
        <h3><?php echo h($user->username); ?></h3>
        <table class="table table-striped">
            <tr>
                <th scope="row"><?php echo __('Faculty'); ?></th>
                <td><?php echo $user->has('faculty') ? $this->Html->link($user->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $user->faculty->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Role'); ?></th>
                <td><?php echo $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Ref Code'); ?></th>
                <td><?php echo h($user->ref_code); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Username'); ?></th>
                <td><?php echo h($user->username); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Password'); ?></th>
                <td><?php echo h($user->password); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Name Prefix'); ?></th>
                <td><?php echo $user->has('name_prefix') ? $this->Html->link($user->name_prefix->name, ['controller' => 'NamePrefixes', 'action' => 'view', $user->name_prefix->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('First Name'); ?></th>
                <td><?php echo h($user->first_name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Last Name'); ?></th>
                <td><?php echo h($user->last_name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Email'); ?></th>
                <td><?php echo h($user->email); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Office Phone'); ?></th>
                <td><?php echo h($user->office_phone); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Mobile Phone'); ?></th>
                <td><?php echo h($user->mobile_phone); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Address'); ?></th>
                <td><?php echo h($user->address); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Moo'); ?></th>
                <td><?php echo h($user->moo); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Road'); ?></th>
                <td><?php echo h($user->road); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Sub District'); ?></th>
                <td><?php echo h($user->sub_district); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('District'); ?></th>
                <td><?php echo h($user->district); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Province'); ?></th>
                <td><?php echo h($user->province); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Zipcode'); ?></th>
                <td><?php echo h($user->zipcode); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Status'); ?></th>
                <td><?php echo h($user->status); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Picture Path'); ?></th>
                <td><?php echo h($user->picture_path); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Id'); ?></th>
                <td><?php echo $this->Number->format($user->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Birth Date'); ?></th>
                <td><?php echo h($user->birth_date); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Created'); ?></th>
                <td><?php echo h($user->created); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Modified'); ?></th>
                <td><?php echo h($user->modified); ?></td>
            </tr>
        </table>
        <?php $this->Html->templates(['icon' => '<i class="fa fa-{{type}}{{attrs.class}}"{{attrs}}></i>']); ?>
        <?php //echo $this->Html->link('i:home', ['action' => 'index']); ?>
        <?php echo $this->Form->button('i:home', ['onclick' => 'window.history.back();']); ?>
        <div class="related">
            <h4><?php echo __('Related Courses'); ?></h4>
            <?php if (!empty($user->courses)): ?>
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
                    <?php foreach ($user->courses as $courses): ?>
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
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="container">
    <div class="row">
        <div class="users index large-9 medium-8 columns content table-responsive">
            <h3><?php echo __('Users') ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?php echo $this->Paginator->sort('faculty_id') ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('role_id') ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('username') ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('first_name') ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('last_name') ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('email') ?></th>
                        <th scope="col"><?php echo $this->Paginator->sort('status') ?></th>
                        <th scope="col" class="actions"><?php echo __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user->has('faculty') ? $this->Html->link($user->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $user->faculty->id]) : '' ?></td>
                            <td><?php echo $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                            <td><?php echo h($user->username) ?></td>
                            <td><?php echo h($user->first_name) ?></td>
                            <td><?php echo h($user->last_name) ?></td>
                            <td><?php echo h($user->email) ?></td>
                            <td><?php echo h($user->status) ?></td>
                            <td class="actions">
                                <?php $this->Html->templates(['icon' => '<i class="fa fa-{{type}}{{attrs.class}}"{{attrs}}></i>']);?>
                                <?php echo $this->Html->link($this->Html->icon('search') . ' ' . __('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info btn-rounded waves-effect waves-light', 'escape' => false]) ?>
                                <?php echo $this->Html->link($this->Html->icon('pencil') . ' ' . __('Edit'), ['action' => 'edit', $user->id], array('class' => 'btn btn-sm btn-warning btn-rounded waves-effect waves-light','escape'=>false)) ?>
                                <?php echo $this->Form->postLink($this->Html->icon('trash') . ' ' . __('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-sm btn-danger btn-rounded waves-effect waves-light confirmModal action-delete','escape'=>false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->element('common/paginator'); ?>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function () {
        //toastr.info('สวัสดีครับศราวุธ');
        //// Display an info toast with no title
//toastr.info('Are you the 6 fingered man?')

        // Display a warning toast, with no title
        //toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')

// Display a success toast, with a title
        //toastr.success('Have fun storming the castle!', 'Miracle Max Says')

// Display an error toast, with a title
        //toastr.error('I do not think that word means what you think it means.', 'Inconceivable!')
    });
</script>
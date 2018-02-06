<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="container">
    <div class="users form large-9 medium-8 columns content">
        <?php echo $this->Form->create($user, ['type' => 'file']); ?>
        <fieldset>
            <legend><?php echo __('Add User'); ?></legend>
            <?php
            echo $this->Form->control('faculty_id', ['options' => $faculties, 'empty' => true]);
            echo $this->Form->control('role_id', ['options' => $roles]);
            echo $this->Form->control('ref_code');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('name_prefix_id', ['options' => $namePrefixes]);
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('office_phone');
            echo $this->Form->control('mobile_phone');
            echo $this->Form->control('birth_date');
            echo $this->Form->control('address');
            echo $this->Form->control('moo');
            echo $this->Form->control('road');
            echo $this->Form->control('sub_district');
            echo $this->Form->control('district');
            echo $this->Form->control('province');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('status');
            echo $this->Form->control('picture_path', ['type' => 'file']);
            echo $this->Form->control('courses._ids', ['options' => $courses]);
//            echo $this->Form->input('mail', ['prepend' => '@', 'append' => $this->Form->button('Send')]);
//            echo $this->Form->input('mail', [
//                'append' => [
//                    $this->Form->button('Button'),
//                    $this->Form->dropdownButton('Dropdown', [
//                        $this->Html->link('A', '#'),
//                        $this->Html->link('B', '#'),
//                        'divider',
//                        $this->Html->link('C', '#')
//                    ])
//                ]
//            ]);
            ?>
        </fieldset>
        <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

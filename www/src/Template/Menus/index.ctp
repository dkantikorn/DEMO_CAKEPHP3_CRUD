<?php
/**
 * 
 * The template for index page of menusController. This page show for short menus informations.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Menu[]|\Cake\Collection\CollectionInterface $menus
 * @since   2017-11-17 11:54:49
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('New Menu'), ['action' => 'add']); ?></li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="menus index large-9 medium-8 columns content table-responsive">
        <h3><?php echo __('Menus'); ?></h3>
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?php echo $this->Paginator->sort('id'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('name'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('name_eng'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('glyphicon'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('domain'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('port'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('sys_controller_id'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('sys_action_id'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('url'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('order_display'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('menu_parent_id'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('child_no'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('status'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('create_uid'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('update_uid'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('created'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('modified'); ?></th>
                    <th scope="col"><?php echo $this->Paginator->sort('page_level'); ?></th>
                    <th scope="col" class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?php echo $this->Number->format($menu->id); ?></td>
                        <td><?php echo h($menu->name); ?></td>
                        <td><?php echo h($menu->name_eng); ?></td>
                        <td><?php echo h($menu->glyphicon); ?></td>
                        <td><?php echo h($menu->domain); ?></td>
                        <td><?php echo h($menu->port); ?></td>
                        <td><?php echo $this->Number->format($menu->sys_controller_id); ?></td>
                        <td><?php echo $this->Number->format($menu->sys_action_id); ?></td>
                        <td><?php echo h($menu->url); ?></td>
                        <td><?php echo $this->Number->format($menu->order_display); ?></td>
                        <td><?php echo $this->Number->format($menu->menu_parent_id); ?></td>
                        <td><?php echo $this->Number->format($menu->child_no); ?></td>
                        <td><?php echo h($menu->status); ?></td>
                        <td><?php echo $this->Number->format($menu->create_uid); ?></td>
                        <td><?php echo $this->Number->format($menu->update_uid); ?></td>
                        <td><?php echo h($menu->created); ?></td>
                        <td><?php echo h($menu->modified); ?></td>
                        <td><?php echo $this->Number->format($menu->page_level); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), ['action' => 'view', $menu->id]); ?>
                            <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]); ?>
                            <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->element('common/paginator'); ?>
    </div>
</div>

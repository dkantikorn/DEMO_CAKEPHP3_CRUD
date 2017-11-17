<?php
/**
 * 
 * The template for view page of menusController.
 * @author  pakgon.Ltd
 * @var     \App\View\AppView $this
 * @var     \App\Model\Entity\Menu $menu
 * @since   2017-11-17 11:54:49
 * @license Pakgon.Ltd
 */
?>
<div class="container">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?php echo __('Actions'); ?></li>
            <li><?php echo $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]); ?> </li>
            <li><?php echo $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]); ?> </li>
            <li><?php echo $this->Html->link(__('List Menus'), ['action' => 'index']); ?> </li>
            <li><?php echo $this->Html->link(__('New Menu'), ['action' => 'add']); ?> </li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="menus view large-9 medium-8 columns content">
        <h3><?php echo h($menu->name); ?></h3>
        <table class="vertical-table table">
            <tr>
                <th scope="row"><?php echo __('Name'); ?></th>
                <td><?php echo h($menu->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Name Eng'); ?></th>
                <td><?php echo h($menu->name_eng); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Glyphicon'); ?></th>
                <td><?php echo h($menu->glyphicon); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Domain'); ?></th>
                <td><?php echo h($menu->domain); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Port'); ?></th>
                <td><?php echo h($menu->port); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Url'); ?></th>
                <td><?php echo h($menu->url); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Status'); ?></th>
                <td><?php echo h($menu->status); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Id'); ?></th>
                <td><?php echo $this->Number->format($menu->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Sys Controller Id'); ?></th>
                <td><?php echo $this->Number->format($menu->sys_controller_id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Sys Action Id'); ?></th>
                <td><?php echo $this->Number->format($menu->sys_action_id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Order Display'); ?></th>
                <td><?php echo $this->Number->format($menu->order_display); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Menu Parent Id'); ?></th>
                <td><?php echo $this->Number->format($menu->menu_parent_id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Child No'); ?></th>
                <td><?php echo $this->Number->format($menu->child_no); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Create Uid'); ?></th>
                <td><?php echo $this->Number->format($menu->create_uid); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Update Uid'); ?></th>
                <td><?php echo $this->Number->format($menu->update_uid); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Page Level'); ?></th>
                <td><?php echo $this->Number->format($menu->page_level); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Created'); ?></th>
                <td><?php echo h($menu->created); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Modified'); ?></th>
                <td><?php echo h($menu->modified); ?></td>
            </tr>
        </table>
        <div class="row">
            <h4><?php echo __('Badge'); ?></h4>
            <?php echo $this->Text->autoParagraph(h($menu->badge)); ?>
        </div>
    </div>
</div>

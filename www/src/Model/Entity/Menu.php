<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property string $name
 * @property string $name_eng
 * @property string $glyphicon
 * @property string $domain
 * @property string $port
 * @property int $sys_controller_id
 * @property int $sys_action_id
 * @property string $url
 * @property int $order_display
 * @property int $menu_parent_id
 * @property int $child_no
 * @property string $status
 * @property int $create_uid
 * @property int $update_uid
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $badge
 * @property int $page_level
 */
class Menu extends Entity {

    /**
     *
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @author  pakgon.Ltd
     * @var     array
     */
    protected $_accessible = [
        'name' => true,
        'name_eng' => true,
        'glyphicon' => true,
        'domain' => true,
        'port' => true,
        'sys_controller_id' => true,
        'sys_action_id' => true,
        'url' => true,
        'order_display' => true,
        'menu_parent_id' => true,
        'child_no' => true,
        'status' => true,
        'create_uid' => true,
        'update_uid' => true,
        'created' => true,
        'modified' => true,
        'badge' => true,
        'page_level' => true
    ];
}

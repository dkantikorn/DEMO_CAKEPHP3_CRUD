<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property string $name
 * @property string $name_eng
 * @property string $description
 * @property string $status
 * @property int $create_uid
 * @property int $update_uid
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User[] $users
 */
class Role extends Entity {

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
        'description' => true,
        'status' => true,
        'create_uid' => true,
        'update_uid' => true,
        'created' => true,
        'modified' => true,
        'users' => true
    ];
}

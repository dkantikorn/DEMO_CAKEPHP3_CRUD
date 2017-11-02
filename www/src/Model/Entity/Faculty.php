<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Faculty Entity
 *
 * @property int $id
 * @property string $faculty_code
 * @property string $name
 * @property string $detail
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Course[] $courses
 * @property \App\Model\Entity\User[] $users
 */
class Faculty extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'faculty_code' => true,
        'name' => true,
        'detail' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'courses' => true,
        'users' => true
    ];
}

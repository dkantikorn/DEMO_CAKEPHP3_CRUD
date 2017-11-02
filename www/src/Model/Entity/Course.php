<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $id
 * @property int $faculty_id
 * @property string $course_code
 * @property string $name
 * @property int $credit
 * @property float $price
 * @property string $detail
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Faculty $faculty
 * @property \App\Model\Entity\User[] $users
 */
class Course extends Entity
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
        'faculty_id' => true,
        'course_code' => true,
        'name' => true,
        'credit' => true,
        'price' => true,
        'detail' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'faculty' => true,
        'users' => true
    ];
}

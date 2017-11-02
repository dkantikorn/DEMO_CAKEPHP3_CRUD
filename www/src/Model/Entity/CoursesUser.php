<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoursesUser Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $days_attended
 * @property float $score
 * @property string $grade
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Course $course
 */
class CoursesUser extends Entity
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
        'user_id' => true,
        'course_id' => true,
        'days_attended' => true,
        'score' => true,
        'grade' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'course' => true
    ];
}

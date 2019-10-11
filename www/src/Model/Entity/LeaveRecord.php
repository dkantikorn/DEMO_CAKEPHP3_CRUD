<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveRecord Entity
 *
 * @property int $id
 * @property string $card_no
 * @property string $order_no
 * @property string $issue_year
 * @property string $sick_leave
 * @property string $errand_leave
 * @property string $holiday_leave
 * @property string $maternity_leave
 * @property string $husband_maternity_leave
 * @property string $ordination_leave
 * @property string $military_leave
 * @property string $edu_leave
 * @property string $inter_work_leave
 * @property string $follow_spouse_leave
 * @property string $rehabilitation_leave
 * @property string $recheck
 * @property string $source_file
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class LeaveRecord extends Entity
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
        'card_no' => true,
        'order_no' => true,
        'issue_year' => true,
        'sick_leave' => true,
        'errand_leave' => true,
        'holiday_leave' => true,
        'maternity_leave' => true,
        'husband_maternity_leave' => true,
        'ordination_leave' => true,
        'military_leave' => true,
        'edu_leave' => true,
        'inter_work_leave' => true,
        'follow_spouse_leave' => true,
        'rehabilitation_leave' => true,
        'area' => true,
        'recheck' => true,
        'source_file' => true,
        'remark' => true,
        'created' => true,
        'modified' => true
    ];
}

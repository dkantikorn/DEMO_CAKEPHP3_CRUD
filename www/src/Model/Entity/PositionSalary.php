<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PositionSalary Entity
 *
 * @property int $id
 * @property string $card_no
 * @property string $issue_date
 * @property string $prev_position
 * @property string $position_name
 * @property string $position_no
 * @property string $salary
 * @property string $salary_level
 * @property string $position_level
 * @property string $ref_title_name
 * @property string $ref_command_follow
 * @property string $ref_command_no
 * @property string $ref_command_date
 * @property string $ref_full
 * @property string $order_no
 * @property string $school
 * @property string $acadamic_standing
 * @property string $recheck
 * @property string $source_file
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class PositionSalary extends Entity
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
        'issue_date' => true,
        'prev_position' => true,
        'position_name' => true,
        'position_no' => true,
        'salary' => true,
        'salary_level' => true,
        'position_level' => true,
        'ref_title_name' => true,
        'ref_command_follow' => true,
        'ref_command_no' => true,
        'ref_command_date' => true,
        'ref_full' => true,
        'order_no' => true,
        'school' => true,
        'code' => true,
        'other' => true,
        'edit_remark' => true,
        'affiliation' => true,
        'acadamic_standing' => true,
        'recheck' => true,
        'source_file' => true,
        'remark' => true,
        'created' => true,
        'modified' => true
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Educational Entity
 *
 * @property int $id
 * @property string $card_no
 * @property string $order_no
 * @property string $school_name
 * @property string $edu_background
 * @property string $major
 * @property string $from_year
 * @property string $finish_year
 * @property string $recheck
 * @property string $source_file
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Educational extends Entity
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
        'school_name' => true,
        'edu_level' => true,
        'edu_background' => true,
        'major' => true,
        'from_year' => true,
        'finish_year' => true,
        'area' => true,
        'recheck' => true,
        'source_file' => true,
        'remark' => true,
        'created' => true,
        'modified' => true
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityLog Entity
 *
 * @property int $id
 * @property string $log_level
 * @property string $log_cat
 * @property string $log_desc
 * @property string $log_val
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class ActivityLog extends Entity
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
        'log_level' => true,
        'log_cat' => true,
        'log_desc' => true,
        'log_val' => true,
        'created' => true,
        'modified' => true
    ];
}

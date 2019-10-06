<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Training Entity
 *
 * @property int $id
 * @property string $card_no
 * @property string $order_no
 * @property string $start_date
 * @property string $finish_date
 * @property string $train_title
 * @property string $train_place
 * @property string $generation
 * @property string $recheck
 * @property string $source_file
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Training extends Entity
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
        'start_date' => true,
        'finish_date' => true,
        'train_title' => true,
        'train_place' => true,
        'generation' => true,
        'recheck' => true,
        'source_file' => true,
        'remark' => true,
        'created' => true,
        'modified' => true
    ];
}

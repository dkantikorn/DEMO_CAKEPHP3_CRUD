<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Insignia Entity
 *
 * @property int $id
 * @property string $card_no
 * @property string $order_no
 * @property string $issue_date
 * @property string $name
 * @property string $book_no
 * @property string $section_no
 * @property string $book_order
 * @property string $page_no
 * @property string $book_issue_date
 * @property string $govenment_gazette
 * @property string $recheck
 * @property string $source_file
 * @property string $remark
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Insignia extends Entity
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
        'issue_date' => true,
        'name' => true,
        'book_no' => true,
        'section_no' => true,
        'book_order' => true,
        'page_no' => true,
        'book_issue_date' => true,
        'govenment_gazette' => true,
        'recheck' => true,
        'source_file' => true,
        'remark' => true,
        'created' => true,
        'modified' => true
    ];
}

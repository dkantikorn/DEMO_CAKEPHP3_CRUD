<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PersonalInfo Entity
 *
 * @property int $id
 * @property string $card_no
 * @property string $ref_no
 * @property string $name_prefix
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $marital_status
 * @property string $blood_group
 * @property string $physical_status
 * @property \Cake\I18n\FrozenDate $issue_date
 * @property \Cake\I18n\FrozenDate $start_date
 * @property string $school
 * @property string $position_no
 * @property string $position_name
 * @property string $position_level
 * @property string $phone_no
 * @property string $father_name_prefix
 * @property string $father_first_name
 * @property string $father_last_name
 * @property string $mother_name_prefix
 * @property string $mother_first_name
 * @property string $mother_last_name
 * @property string $spouse_name_prefix
 * @property string $spouse_first_name
 * @property string $spouse_last_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class PersonalInfo extends Entity
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
        'ref_no' => true,
        'name_prefix' => true,
        'first_name' => true,
        'last_name' => true,
        'gender' => true,
        'date_of_birth' => true,
        'marital_status' => true,
        'blood_group' => true,
        'physical_status' => true,
        'issue_date' => true,
        'start_date' => true,
        'school' => true,
        'position_no' => true,
        'position_name' => true,
        'position_level' => true,
        'phone_no' => true,
        'father_name_prefix' => true,
        'father_first_name' => true,
        'father_last_name' => true,
        'mother_name_prefix' => true,
        'mother_first_name' => true,
        'mother_last_name' => true,
        'spouse_name_prefix' => true,
        'spouse_first_name' => true,
        'spouse_last_name' => true,
        'created' => true,
        'modified' => true
    ];
}

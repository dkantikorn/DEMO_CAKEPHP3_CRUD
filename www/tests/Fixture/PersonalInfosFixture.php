<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PersonalInfosFixture
 *
 */
class PersonalInfosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'card_no' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'หมายเลขบัตรประชาชน', 'precision' => null, 'fixed' => null],
        'ref_no' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'เลขที่เล่ม', 'precision' => null, 'fixed' => null],
        'name_prefix' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'คำนำหน้าชื่อ', 'precision' => null, 'fixed' => null],
        'first_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อตัว', 'precision' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อสกุล', 'precision' => null, 'fixed' => null],
        'gender' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'เพศ', 'precision' => null, 'fixed' => null],
        'date_of_birth' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'วัน/เดือน/ปีเกิด', 'precision' => null],
        'marital_status' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'สถานภาพสมรส', 'precision' => null, 'fixed' => null],
        'blood_group' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'กรุ๊ปเลือด', 'precision' => null, 'fixed' => null],
        'physical_status' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'สถานภาพทางกาย', 'precision' => null, 'fixed' => null],
        'issue_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'วันที่สั่งบรรจุ', 'precision' => null],
        'start_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'วันที่เริ่มปฏิบัติงาน', 'precision' => null],
        'school' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'สถานศึกษา', 'precision' => null, 'fixed' => null],
        'position_no' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'เลขที่ตำแหน่ง', 'precision' => null, 'fixed' => null],
        'position_name' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ตำแหน่ง', 'precision' => null, 'fixed' => null],
        'position_level' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อันดับ/ระดับ', 'precision' => null, 'fixed' => null],
        'phone_no' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'หมายเลขโทรศัพท์', 'precision' => null, 'fixed' => null],
        'father_name_prefix' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'คำนำหน้าชื่อ บิดา', 'precision' => null, 'fixed' => null],
        'father_first_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อบิดา', 'precision' => null, 'fixed' => null],
        'father_last_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'นามสกุลบิดา', 'precision' => null, 'fixed' => null],
        'mother_name_prefix' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'นำหน้าชื่อมารดา', 'precision' => null, 'fixed' => null],
        'mother_first_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อมารดา', 'precision' => null, 'fixed' => null],
        'mother_last_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'นามสกุลมารดา', 'precision' => null, 'fixed' => null],
        'spouse_name_prefix' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'นำหน้าชื่อคู่สมรส', 'precision' => null, 'fixed' => null],
        'spouse_first_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อคู่สมรส', 'precision' => null, 'fixed' => null],
        'spouse_last_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'นามสกุลคู่สมรส', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'วันที่เพิ่มข้อมูล', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'วันที่แก้ไขข้อมูล', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'card_no' => 'Lorem ipsum dolor ',
            'ref_no' => 'Lorem ipsum dolor ',
            'name_prefix' => 'Lorem ipsum dolor sit amet',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'gender' => 'Lorem ipsum dolor sit amet',
            'date_of_birth' => '2019-07-02',
            'marital_status' => 'Lorem ipsum dolor sit amet',
            'blood_group' => 'Lorem ipsum dolor sit amet',
            'physical_status' => 'Lorem ipsum dolor sit amet',
            'issue_date' => '2019-07-02',
            'start_date' => '2019-07-02',
            'school' => 'Lorem ipsum dolor sit amet',
            'position_no' => 'Lorem ipsum dolor sit amet',
            'position_name' => 'Lorem ipsum dolor sit amet',
            'position_level' => 'Lorem ipsum dolor sit amet',
            'phone_no' => 'Lorem ipsum dolor ',
            'father_name_prefix' => 'Lorem ipsum dolor sit amet',
            'father_first_name' => 'Lorem ipsum dolor sit amet',
            'father_last_name' => 'Lorem ipsum dolor sit amet',
            'mother_name_prefix' => 'Lorem ipsum dolor sit amet',
            'mother_first_name' => 'Lorem ipsum dolor sit amet',
            'mother_last_name' => 'Lorem ipsum dolor sit amet',
            'spouse_name_prefix' => 'Lorem ipsum dolor sit amet',
            'spouse_first_name' => 'Lorem ipsum dolor sit amet',
            'spouse_last_name' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-07-02 11:19:20',
            'modified' => '2019-07-02 11:19:20'
        ],
    ];
}

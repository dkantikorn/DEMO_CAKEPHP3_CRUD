<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PositionSalariesFixture
 *
 */
class PositionSalariesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'card_no' => ['type' => 'string', 'length' => 25, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'เลขประจำตัวประชาชน', 'precision' => null, 'fixed' => null],
        'issue_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วันที่ / วัน/เดือน/ปี พ.ศ.', 'precision' => null, 'fixed' => null],
        'prev_position' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ตำแหน่งเดิม / ตำแหน่งต้นฉบับ', 'precision' => null, 'fixed' => null],
        'position_name' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ตำแหน่ง', 'precision' => null, 'fixed' => null],
        'position_no' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ตำแหน่งเลขที่ / เลขที่ตำแหน่ง', 'precision' => null, 'fixed' => null],
        'salary' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อัตราเงินเดือน', 'precision' => null, 'fixed' => null],
        'salary_level' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'หมายเหตุกรณีมีปัญหา / ขั้น  (ไม่มีใน MF)', 'precision' => null, 'fixed' => null],
        'position_level' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อันดับ/ระดับของตำแหน่ง', 'precision' => null, 'fixed' => null],
        'ref_title_name' => ['type' => 'string', 'length' => 1024, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อ้างอิง (เรื่อง) / อ้างอิง', 'precision' => null, 'fixed' => null],
        'ref_command_follow' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อ้างอิง (ตามคำสั่ง)', 'precision' => null, 'fixed' => null],
        'ref_command_no' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อ้างอิง (เลขที่คำสั่ง)', 'precision' => null, 'fixed' => null],
        'ref_command_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อ้างอิง (ลงวันที่)', 'precision' => null, 'fixed' => null],
        'ref_full' => ['type' => 'string', 'length' => 2048, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'อ้างอิง (ทั้งหมด)', 'precision' => null, 'fixed' => null],
        'order_no' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ลำดับที่', 'precision' => null, 'fixed' => null],
        'school' => ['type' => 'string', 'length' => 1028, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อสถานศึกษา (ไม่มีใน MF)', 'precision' => null, 'fixed' => null],
        'acadamic_standing' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วิทยฐานะ (ไม่มีใน MF)', 'precision' => null, 'fixed' => null],
        'recheck' => ['type' => 'string', 'fixed' => true, 'length' => 1, 'null' => true, 'default' => 'N', 'collate' => 'utf8_general_ci', 'comment' => 'ตรวจสอบ', 'precision' => null],
        'source_file' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ไฟล์ต้นฉบับ', 'precision' => null, 'fixed' => null],
        'remark' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'หมายเหตุ', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'วันที่ับันทึกข้อมูล', 'precision' => null],
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
            'card_no' => 'Lorem ipsum dolor sit a',
            'issue_date' => 'Lorem ipsum dolor ',
            'prev_position' => 'Lorem ipsum dolor sit amet',
            'position_name' => 'Lorem ipsum dolor sit amet',
            'position_no' => 'Lorem ipsum dolor sit amet',
            'salary' => 'Lorem ipsum dolor sit amet',
            'salary_level' => 'Lorem ipsum dolor sit amet',
            'position_level' => 'Lorem ipsum dolor sit amet',
            'ref_title_name' => 'Lorem ipsum dolor sit amet',
            'ref_command_follow' => 'Lorem ipsum dolor sit amet',
            'ref_command_no' => 'Lorem ipsum dolor sit amet',
            'ref_command_date' => 'Lorem ipsum dolor ',
            'ref_full' => 'Lorem ipsum dolor sit amet',
            'order_no' => 'Lorem ip',
            'school' => 'Lorem ipsum dolor sit amet',
            'acadamic_standing' => 'Lorem ipsum dolor sit amet',
            'recheck' => 'Lorem ipsum dolor sit ame',
            'source_file' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-09-09 05:29:06',
            'modified' => '2019-09-09 05:29:06'
        ],
    ];
}

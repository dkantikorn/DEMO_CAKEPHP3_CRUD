<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EducationalsFixture
 *
 */
class EducationalsFixture extends TestFixture
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
        'order_no' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ลำดับที่', 'precision' => null, 'fixed' => null],
        'school_name' => ['type' => 'string', 'length' => 1028, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อสถานศึกษา', 'precision' => null, 'fixed' => null],
        'edu_background' => ['type' => 'string', 'length' => 1028, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วุฒิการศึกษา', 'precision' => null, 'fixed' => null],
        'major' => ['type' => 'string', 'length' => 1028, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วิชาเอก (ไม่มีใน MF)', 'precision' => null, 'fixed' => null],
        'from_year' => ['type' => 'string', 'length' => 6, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ตั้งแต่ปี พ.ศ.', 'precision' => null, 'fixed' => null],
        'finish_year' => ['type' => 'string', 'length' => 6, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ถึงปี พ.ศ.', 'precision' => null, 'fixed' => null],
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
            'order_no' => 'Lorem ip',
            'school_name' => 'Lorem ipsum dolor sit amet',
            'edu_background' => 'Lorem ipsum dolor sit amet',
            'major' => 'Lorem ipsum dolor sit amet',
            'from_year' => 'Lore',
            'finish_year' => 'Lore',
            'recheck' => 'Lorem ipsum dolor sit ame',
            'source_file' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-10-06 03:35:21',
            'modified' => '2019-10-06 03:35:21'
        ],
    ];
}

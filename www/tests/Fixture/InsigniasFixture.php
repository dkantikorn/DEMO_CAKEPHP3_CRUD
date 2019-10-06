<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InsigniasFixture
 *
 */
class InsigniasFixture extends TestFixture
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
        'issue_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วันที่ได้รับ', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อเครื่องราชฯ', 'precision' => null, 'fixed' => null],
        'book_no' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'เลขที่/เล่มที่', 'precision' => null, 'fixed' => null],
        'section_no' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ตอนที่', 'precision' => null, 'fixed' => null],
        'book_order' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ลำดับที่ เครื่องราชฯ', 'precision' => null, 'fixed' => null],
        'page_no' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'หน้าที่', 'precision' => null, 'fixed' => null],
        'book_issue_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วันที่', 'precision' => null, 'fixed' => null],
        'govenment_gazette' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ราชกิจจานุเบกษาฉบับ ไม่มีใน OA', 'precision' => null, 'fixed' => null],
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
            'issue_date' => 'Lorem ipsum dolor ',
            'name' => 'Lorem ipsum dolor sit amet',
            'book_no' => 'Lorem ipsum dolor ',
            'section_no' => 'Lorem ipsum dolor ',
            'book_order' => 'Lorem ip',
            'page_no' => 'Lorem ip',
            'book_issue_date' => 'Lorem ipsum dolor ',
            'govenment_gazette' => 'Lorem ipsum dolor sit amet',
            'recheck' => 'Lorem ipsum dolor sit ame',
            'source_file' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-10-06 03:36:19',
            'modified' => '2019-10-06 03:36:19'
        ],
    ];
}

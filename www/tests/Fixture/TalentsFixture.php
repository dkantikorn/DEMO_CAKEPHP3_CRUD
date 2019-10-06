<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TalentsFixture
 *
 */
class TalentsFixture extends TestFixture
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
        'issue_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วันที่ ไม่มีในMF', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'รายการ', 'precision' => null],
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
            'name' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'recheck' => 'Lorem ipsum dolor sit ame',
            'source_file' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-10-06 03:38:54',
            'modified' => '2019-10-06 03:38:54'
        ],
    ];
}

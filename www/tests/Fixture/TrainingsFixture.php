<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TrainingsFixture
 *
 */
class TrainingsFixture extends TestFixture
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
        'start_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วันที่เริ่ม การอบรม', 'precision' => null, 'fixed' => null],
        'finish_date' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'วันที่สิ้นสุด การอบรม', 'precision' => null, 'fixed' => null],
        'train_title' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'รายละเอียด (ชื่อ/หัวข้อ)', 'precision' => null],
        'train_place' => ['type' => 'string', 'length' => 2048, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'สถานที่จัดอบรม', 'precision' => null, 'fixed' => null],
        'generation' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'รุ่นที่ ไม่มีใน OA', 'precision' => null, 'fixed' => null],
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
            'start_date' => 'Lorem ipsum dolor ',
            'finish_date' => 'Lorem ipsum dolor ',
            'train_title' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'train_place' => 'Lorem ipsum dolor sit amet',
            'generation' => 'Lorem ipsum dolor ',
            'recheck' => 'Lorem ipsum dolor sit ame',
            'source_file' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-10-06 03:39:25',
            'modified' => '2019-10-06 03:39:25'
        ],
    ];
}

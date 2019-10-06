<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeaveRecordsFixture
 *
 */
class LeaveRecordsFixture extends TestFixture
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
        'issue_year' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ชื่อสถานศึกษา', 'precision' => null, 'fixed' => null],
        'sick_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาป่วย', 'precision' => null, 'fixed' => null],
        'errand_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลากิจ', 'precision' => null, 'fixed' => null],
        'holiday_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาพักร้อน / ลาพักผ่อน', 'precision' => null, 'fixed' => null],
        'maternity_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาคลอด', 'precision' => null, 'fixed' => null],
        'husband_maternity_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาช่วยภริยาคลอดบุตร', 'precision' => null, 'fixed' => null],
        'ordination_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาอุปสมบท/พิธีฮัจย์', 'precision' => null, 'fixed' => null],
        'military_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาเข้ารับการตรวจเลือก/เตรียมพล', 'precision' => null, 'fixed' => null],
        'edu_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาศึกษาต่อ', 'precision' => null, 'fixed' => null],
        'inter_work_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาปฏิบัติงานในองค์การระหว่างประเทศ', 'precision' => null, 'fixed' => null],
        'follow_spouse_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาติดตามคู่สมรส', 'precision' => null, 'fixed' => null],
        'rehabilitation_leave' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => 'ลาฟื้นฟูสมรรถภาพ', 'precision' => null, 'fixed' => null],
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
            'issue_year' => 'Lorem ipsum dolor ',
            'sick_leave' => 'Lorem ip',
            'errand_leave' => 'Lorem ip',
            'holiday_leave' => 'Lorem ip',
            'maternity_leave' => 'Lorem ip',
            'husband_maternity_leave' => 'Lorem ip',
            'ordination_leave' => 'Lorem ip',
            'military_leave' => 'Lorem ip',
            'edu_leave' => 'Lorem ip',
            'inter_work_leave' => 'Lorem ip',
            'follow_spouse_leave' => 'Lorem ip',
            'rehabilitation_leave' => 'Lorem ip',
            'recheck' => 'Lorem ipsum dolor sit ame',
            'source_file' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'created' => '2019-10-06 03:36:52',
            'modified' => '2019-10-06 03:36:52'
        ],
    ];
}

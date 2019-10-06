<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveRecordsTable Test Case
 */
class LeaveRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveRecordsTable
     */
    public $LeaveRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.leave_records'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LeaveRecords') ? [] : ['className' => LeaveRecordsTable::class];
        $this->LeaveRecords = TableRegistry::get('LeaveRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveRecords);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

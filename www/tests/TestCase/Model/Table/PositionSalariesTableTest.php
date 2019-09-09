<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PositionSalariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PositionSalariesTable Test Case
 */
class PositionSalariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PositionSalariesTable
     */
    public $PositionSalaries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.position_salaries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PositionSalaries') ? [] : ['className' => PositionSalariesTable::class];
        $this->PositionSalaries = TableRegistry::get('PositionSalaries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PositionSalaries);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InsigniasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InsigniasTable Test Case
 */
class InsigniasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InsigniasTable
     */
    public $Insignias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.insignias'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Insignias') ? [] : ['className' => InsigniasTable::class];
        $this->Insignias = TableRegistry::get('Insignias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Insignias);

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

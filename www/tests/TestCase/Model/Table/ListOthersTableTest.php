<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ListOthersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ListOthersTable Test Case
 */
class ListOthersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ListOthersTable
     */
    public $ListOthers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.list_others'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ListOthers') ? [] : ['className' => ListOthersTable::class];
        $this->ListOthers = TableRegistry::get('ListOthers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ListOthers);

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

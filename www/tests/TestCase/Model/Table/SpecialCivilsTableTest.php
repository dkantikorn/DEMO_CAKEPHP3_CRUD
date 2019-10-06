<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecialCivilsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecialCivilsTable Test Case
 */
class SpecialCivilsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SpecialCivilsTable
     */
    public $SpecialCivils;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.special_civils'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SpecialCivils') ? [] : ['className' => SpecialCivilsTable::class];
        $this->SpecialCivils = TableRegistry::get('SpecialCivils', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SpecialCivils);

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

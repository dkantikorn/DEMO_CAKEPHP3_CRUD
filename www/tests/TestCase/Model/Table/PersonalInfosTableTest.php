<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonalInfosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonalInfosTable Test Case
 */
class PersonalInfosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonalInfosTable
     */
    public $PersonalInfos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.personal_infos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PersonalInfos') ? [] : ['className' => PersonalInfosTable::class];
        $this->PersonalInfos = TableRegistry::get('PersonalInfos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PersonalInfos);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NamePrefixesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NamePrefixesTable Test Case
 */
class NamePrefixesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NamePrefixesTable
     */
    public $NamePrefixes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.name_prefixes',
        'app.users',
        'app.faculties',
        'app.courses',
        'app.courses_users',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NamePrefixes') ? [] : ['className' => NamePrefixesTable::class];
        $this->NamePrefixes = TableRegistry::get('NamePrefixes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NamePrefixes);

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
}

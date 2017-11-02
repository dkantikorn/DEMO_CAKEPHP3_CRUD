<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoursesUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoursesUsersTable Test Case
 */
class CoursesUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoursesUsersTable
     */
    public $CoursesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.courses_users',
        'app.users',
        'app.faculties',
        'app.courses',
        'app.roles',
        'app.name_prefixes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CoursesUsers') ? [] : ['className' => CoursesUsersTable::class];
        $this->CoursesUsers = TableRegistry::get('CoursesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoursesUsers);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

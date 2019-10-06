<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EducationalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EducationalsTable Test Case
 */
class EducationalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EducationalsTable
     */
    public $Educationals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.educationals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Educationals') ? [] : ['className' => EducationalsTable::class];
        $this->Educationals = TableRegistry::get('Educationals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Educationals);

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

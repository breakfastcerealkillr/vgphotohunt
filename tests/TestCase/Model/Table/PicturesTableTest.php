<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PicturesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PicturesTable Test Case
 */
class PicturesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Pictures' => 'app.pictures',
        'Users' => 'app.users',
        'Steams' => 'app.steams',
        'PictureComments' => 'app.picture_comments',
        'Upvotes' => 'app.upvotes',
        'Sets' => 'app.sets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pictures') ? [] : ['className' => 'App\Model\Table\PicturesTable'];
        $this->Pictures = TableRegistry::get('Pictures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pictures);

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

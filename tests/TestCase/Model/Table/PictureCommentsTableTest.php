<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PictureCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PictureCommentsTable Test Case
 */
class PictureCommentsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'PictureComments' => 'app.picture_comments',
        'Pictures' => 'app.pictures',
        'Users' => 'app.users',
        'Steams' => 'app.steams',
        'Upvotes' => 'app.upvotes',
        'Sets' => 'app.sets',
        'Games' => 'app.games',
        'WinnerUsers' => 'app.winner_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PictureComments') ? [] : ['className' => 'App\Model\Table\PictureCommentsTable'];
        $this->PictureComments = TableRegistry::get('PictureComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PictureComments);

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

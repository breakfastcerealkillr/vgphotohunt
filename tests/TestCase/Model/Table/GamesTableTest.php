<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GamesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GamesTable Test Case
 */
class GamesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Games' => 'app.games',
        'Sets' => 'app.sets',
        'WinnerUsers' => 'app.winner_users',
        'Pictures' => 'app.pictures',
        'Users' => 'app.users',
        'Steams' => 'app.steams',
        'PictureComments' => 'app.picture_comments',
        'Upvotes' => 'app.upvotes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Games') ? [] : ['className' => 'App\Model\Table\GamesTable'];
        $this->Games = TableRegistry::get('Games', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Games);

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

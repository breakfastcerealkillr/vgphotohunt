<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GamesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GamesController Test Case
 */
class GamesControllerTest extends IntegrationTestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

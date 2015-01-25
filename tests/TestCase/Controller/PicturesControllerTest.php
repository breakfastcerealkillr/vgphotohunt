<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PicturesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PicturesController Test Case
 */
class PicturesControllerTest extends IntegrationTestCase
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

<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\StatusBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\StatusBehavior Test Case
 */
class StatusBehaviorTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Status = new StatusBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Status);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

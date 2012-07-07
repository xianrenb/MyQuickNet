<?php

/**
 * MQNAutoRecordManagerTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 * Test class for MQNAutoRecordManager.
 */
class MQNAutoRecordManagerTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var string
     */
    private $testingAutoRecordManagerClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->testingAutoRecordManagerClass = 'TestingAutoRecordManager';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $manager = new $this->testingAutoRecordManagerClass();
        $this->assertTrue($manager instanceof MQNAutoRecordManager);
        $this->assertTrue($manager->methodA() == 'TestingAutoRecordManager');
        $database = $manager->getDatabase();
        $this->assertTrue($database instanceof MQNDatabase);
    }

}

?>

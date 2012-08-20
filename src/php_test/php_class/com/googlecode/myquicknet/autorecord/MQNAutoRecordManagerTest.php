<?php

/**
 * MQNAutoRecordManagerTest
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\database\MQNDatabase;

/**
 * Test class for MQNAutoRecordManager.
 */
class MQNAutoRecordManagerTest extends \PHPUnit_Framework_TestCase {

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

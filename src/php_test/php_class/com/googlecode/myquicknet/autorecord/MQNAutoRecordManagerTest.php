<?php

/**
 * MQNAutoRecordManagerTest
 * @package MyQuickNet
 * @version 4.5
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\database\MQNDatabase;

/**
 * Test class for MQNAutoRecordManager.
 */
class MQNAutoRecordManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var string
     */
    private $testingAutoRecordManagerClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->testingAutoRecordManagerClass = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordManager';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function test1()
    {
        $managerClass = (string) $this->testingAutoRecordManagerClass;
        $manager = $managerClass::getInstance();
        $this->assertTrue($manager instanceof MQNAutoRecordManager);
        $this->assertTrue($manager->methodA() == 'TestingAutoRecordManager');
        $manager->bind();
        $database = $manager->getDatabase();
        $this->assertTrue($database instanceof MQNDatabase);
        $manager->unbind();
        $manager = null;
    }

}

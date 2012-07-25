<?php

/**
 * MQNAutoRecordQueryTableTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 * Test class for MQNAutoRecordQueryTable.
 */
class MQNAutoRecordQueryTableTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var string
     */
    private $testingAutoRecordClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->testingAutoRecordClass = 'TestingAutoRecord';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $table = new MQNAutoRecordQueryTable();
        $this->assertTrue($table instanceof MQNAutoRecordQueryTable);
        $table = null;
    }

    public function test2() {
        $table = new MQNAutoRecordQueryTable(1, 'name');
        $this->assertTrue($table instanceof MQNAutoRecordQueryTable);
        $this->assertTrue($table->getId() == 1);
        $this->assertTrue($table->getName() == 'name');
        $table = null;
    }

    public function test3() {
        $table = new MQNAutoRecordQueryTable(1, 'name');
        $this->assertTrue($table instanceof MQNAutoRecordQueryTable);
        $autoRecordClassName = (string) $this->testingAutoRecordClass;
        $autoRecord = new $autoRecordClassName();
        $table->setAutoRecord($autoRecord);
        $table->setAutoRecordClassName($autoRecordClassName);
        $this->assertEquals($autoRecordClassName, $table->getAutoRecordClassName());
        $table = null;
    }

}

?>

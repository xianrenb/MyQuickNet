<?php

/**
 * MQNAutoRecordQueryResultTest
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQueryResult.
 */
class MQNAutoRecordQueryResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var string
     */
    private $testingAutoRecordClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->testingAutoRecordClass = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecord';
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
        $result = new MQNAutoRecordQueryResult();
        $this->assertTrue($result instanceof MQNAutoRecordQueryResult);
    }

    public function test2()
    {
        $result = new MQNAutoRecordQueryResult(1, 'name');
        $this->assertTrue($result instanceof MQNAutoRecordQueryResult);
        $this->assertTrue($result->getId() === 1);
        $this->assertTrue($result->getName() === 'name');
    }

    public function test3()
    {
        $result = new MQNAutoRecordQueryResult(1, 'result');
        $this->assertTrue($result instanceof MQNAutoRecordQueryResult);
        $table = new MQNAutoRecordQueryTable(2, 'table');
        $autoRecordClassName = (string) $this->testingAutoRecordClass;
        $autoRecord = new $autoRecordClassName();
        $table->setAutoRecord($autoRecord);
        $table->setAutoRecordClassName($autoRecordClassName);
        $expectedAutoRecord = new $autoRecordClassName();
        $expectedAutoRecord->create();
        $expectedAutoRecord->update();
        $a = array('id' . $table->getId() => $expectedAutoRecord->getId());
        $result->setResult($a);
        $this->assertEquals($expectedAutoRecord->getId(), $result->getAutoRecordId($table));
        $this->assertTrue($result->getAutoRecord($table) instanceof MQNAutoRecord);
        $this->assertEquals($expectedAutoRecord->getId(), $result->getAutoRecord($table)->getId());
        $expectedAutoRecord->delete();
        $autoRecord = null;
        $expectedAutoRecord = null;
    }

    public function test4()
    {
        $result = new MQNAutoRecordQueryResult(1, 'result');
        $this->assertTrue($result instanceof MQNAutoRecordQueryResult);
        $table1 = new MQNAutoRecordQueryTable(2, 'table1');
        $table2 = new MQNAutoRecordQueryTable(3, 'table2');
        $autoRecordClassName = (string) $this->testingAutoRecordClass;
        $autoRecord1 = new $autoRecordClassName();
        $autoRecord2 = new $autoRecordClassName();
        $table1->setAutoRecord($autoRecord1);
        $table1->setAutoRecordClassName($autoRecordClassName);
        $table2->setAutoRecord($autoRecord2);
        $table2->setAutoRecordClassName($autoRecordClassName);
        $expectedAutoRecord1 = new $autoRecordClassName();
        $expectedAutoRecord1->create();
        $expectedAutoRecord1->update();
        $expectedAutoRecord2 = new $autoRecordClassName();
        $expectedAutoRecord2->create();
        $expectedAutoRecord2->update();
        $a = array(
            'id' . $table1->getId() => $expectedAutoRecord1->getId(),
            'id' . $table2->getId() => $expectedAutoRecord2->getId()
        );
        $result->setResult($a);
        $this->assertEquals($expectedAutoRecord1->getId(), $result->getAutoRecordId($table1));
        $this->assertTrue($result->getAutoRecord($table1) instanceof MQNAutoRecord);
        $this->assertEquals($expectedAutoRecord1->getId(), $result->getAutoRecord($table1)->getId());
        $this->assertEquals($expectedAutoRecord2->getId(), $result->getAutoRecordId($table2));
        $this->assertTrue($result->getAutoRecord($table2) instanceof MQNAutoRecord);
        $this->assertEquals($expectedAutoRecord2->getId(), $result->getAutoRecord($table2)->getId());
        $expectedAutoRecord1->delete();
        $expectedAutoRecord2->delete();
        $autoRecord1 = null;
        $autoRecord2 = null;
        $expectedAutoRecord1 = null;
        $expectedAutoRecord2 = null;
    }

}

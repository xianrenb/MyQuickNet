<?php

/**
 * MQNAutoRecordQueryJoinConditionTest
 * @package MyQuickNet
 * @version 4.5
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQueryJoinCondition.
 */
class MQNAutoRecordQueryJoinConditionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
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
        $joinCondition = new MQNAutoRecordQueryJoinCondition();
        $this->assertTrue($joinCondition instanceof MQNAutoRecordQueryJoinCondition);
    }

    public function test2()
    {
        $joinCondition = new MQNAutoRecordQueryJoinCondition(1, 'name');
        $this->assertTrue($joinCondition instanceof MQNAutoRecordQueryJoinCondition);
        $this->assertTrue($joinCondition->getId() == 1);
        $this->assertTrue($joinCondition->getName() == 'name');
    }

    public function test3()
    {
        $joinCondition = new MQNAutoRecordQueryJoinCondition(1, 'field');
        $this->assertTrue($joinCondition instanceof MQNAutoRecordQueryJoinCondition);
        $field1 = new MQNAutoRecordQueryField(2, 'field1');
        $field2 = new MQNAutoRecordQueryField(3, 'field2');
        $joinCondition->setField1($field1);
        $joinCondition->setField2($field2);
        $this->assertEquals($field1, $joinCondition->getField1());
        $this->assertEquals($field2, $joinCondition->getField2());
    }

}

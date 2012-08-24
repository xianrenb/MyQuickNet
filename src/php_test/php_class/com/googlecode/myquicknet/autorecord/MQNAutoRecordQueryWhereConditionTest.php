<?php

/**
 * MQNAutoRecordQueryWhereConditionTest
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQueryWhereCondition.
 */
class MQNAutoRecordQueryWhereConditionTest extends \PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $whereCondition = new MQNAutoRecordQueryWhereCondition();
        $this->assertTrue($whereCondition instanceof MQNAutoRecordQueryWhereCondition);
        $this->assertFalse($whereCondition->getOrNext());
        $whereCondition->setOrNext(true);
        $this->assertTrue($whereCondition->getOrNext());
        $whereCondition->setOrNext(false);
        $this->assertFalse($whereCondition->getOrNext());
    }

    public function test2() {
        $whereCondition = new MQNAutoRecordQueryWhereCondition(1, 'name');
        $this->assertTrue($whereCondition instanceof MQNAutoRecordQueryWhereCondition);
        $this->assertTrue($whereCondition->getId() == 1);
        $this->assertTrue($whereCondition->getName() == 'name');
    }

    public function test3() {
        $whereCondition = new MQNAutoRecordQueryWhereCondition(1, 'field');
        $this->assertTrue($whereCondition instanceof MQNAutoRecordQueryWhereCondition);
        $operator = '=';
        $value1 = 1;
        $value2 = 2;
        $whereCondition->setOperator($operator);
        $whereCondition->setValue1($value1);
        $whereCondition->setValue2($value2);
        $this->assertEquals($operator, $whereCondition->getOperator());
        $this->assertEquals($value1, $whereCondition->getValue1());
        $this->assertEquals($value2, $whereCondition->getValue2());
    }

    public function test4() {
        $whereCondition = new MQNAutoRecordQueryWhereCondition(1, 'field');
        $this->assertTrue($whereCondition instanceof MQNAutoRecordQueryWhereCondition);
        $operator = '=';
        $value1 = new MQNAutoRecordQueryField(1, 'name');
        $value2 = 2;
        $whereCondition->setOperator($operator);
        $whereCondition->setValue1($value1);
        $whereCondition->setValue2($value2);
        $this->assertEquals($operator, $whereCondition->getOperator());
        $this->assertEquals($value1, $whereCondition->getValue1());
        $this->assertEquals($value2, $whereCondition->getValue2());
    }

    public function test5() {
        $whereCondition = new MQNAutoRecordQueryWhereCondition(1, 'field');
        $this->assertTrue($whereCondition instanceof MQNAutoRecordQueryWhereCondition);
        $operator = '=';
        $value1 = 1;
        $value2 = new MQNAutoRecordQueryField(2, 'name');
        $whereCondition->setOperator($operator);
        $whereCondition->setValue1($value1);
        $whereCondition->setValue2($value2);
        $this->assertEquals($operator, $whereCondition->getOperator());
        $this->assertEquals($value1, $whereCondition->getValue1());
        $this->assertEquals($value2, $whereCondition->getValue2());
    }

    public function test6() {
        $whereCondition = new MQNAutoRecordQueryWhereCondition(1, 'field');
        $this->assertTrue($whereCondition instanceof MQNAutoRecordQueryWhereCondition);
        $operator = '=';
        $value1 = new MQNAutoRecordQueryField(1, 'name1');
        $value2 = new MQNAutoRecordQueryField(2, 'name2');
        $whereCondition->setOperator($operator);
        $whereCondition->setValue1($value1);
        $whereCondition->setValue2($value2);
        $this->assertEquals($operator, $whereCondition->getOperator());
        $this->assertEquals($value1, $whereCondition->getValue1());
        $this->assertEquals($value2, $whereCondition->getValue2());
    }

}

?>

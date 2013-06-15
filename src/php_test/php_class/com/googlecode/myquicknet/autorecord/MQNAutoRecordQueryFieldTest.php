<?php

/**
 * MQNAutoRecordQueryFieldTest
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQueryField.
 */
class MQNAutoRecordQueryFieldTest extends \PHPUnit_Framework_TestCase
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
        $field = new MQNAutoRecordQueryField();
        $this->assertTrue($field instanceof MQNAutoRecordQueryField);
    }

    public function test2()
    {
        $field = new MQNAutoRecordQueryField(1, 'name');
        $this->assertTrue($field instanceof MQNAutoRecordQueryField);
        $this->assertTrue($field->getId() === 1);
        $this->assertTrue($field->getName() === 'name');
    }

    public function test3()
    {
        $field = new MQNAutoRecordQueryField(1, 'field');
        $this->assertTrue($field instanceof MQNAutoRecordQueryField);
        $table = new MQNAutoRecordQueryTable(2, 'table');
        $field->setTable($table);
        $this->assertEquals($table, $field->getTable());
    }

}

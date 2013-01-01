<?php

/**
 * MQNDatabaseStatementTest
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabaseStatement.
 */
class MQNDatabaseStatementTest extends \PHPUnit_Framework_TestCase
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

    public function testExecute()
    {
        $statement = new MQNDatabaseStatement(null);
        $result = $statement->execute();
        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }

}

<?php

/**
 * MQNDatabaseTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabase.
 */
class MQNDatabaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var array
     */
    private $config;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $config = array();
        $this->config = $config;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testBegin()
    {
        $o = new MQNDatabase($this->config);
        $this->assertFalse($o->begin());
    }

    public function testClose()
    {
        $o = new MQNDatabase($this->config);
        $this->assertFalse($o->close());
    }

    public function testCommit()
    {
        $o = new MQNDatabase($this->config);
        $this->assertFalse($o->commit());
    }

    public function testConnect()
    {
        $o = new MQNDatabase($this->config);
        $this->assertFalse($o->connect());
    }

    public function testEscapeString()
    {
        $o = new MQNDatabase($this->config);
        $this->assertEquals('string', $o->escapeString('string'));
    }

    public function testIsReady()
    {
        $o = new MQNDatabase($this->config);
        $this->assertFalse($o->isReady());
    }

    public function testPrepare()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $statement = $o->prepare($sql);
        $this->assertTrue($statement instanceof MQNDatabaseStatement);
        $statement = null;
    }

    public function testPrepareForUpdate()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $statement = $o->prepareForUpdate($sql);
        $this->assertTrue($statement instanceof MQNDatabaseStatement);
        $statement = null;
    }

    public function testPrepareLimit()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $row_count = 2;
        $offset = 3;
        $statement = $o->prepareLimit($sql, $row_count);
        $this->assertTrue($statement instanceof MQNDatabaseStatement);
        $statement = null;
        $statement = $o->prepareLimit($sql, $row_count, $offset);
        $this->assertTrue($statement instanceof MQNDatabaseStatement);
        $statement = null;
    }

    public function testPrepareLimitForUpdate()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $row_count = 2;
        $offset = 3;
        $statement = $o->prepareLimitForUpdate($sql, $row_count);
        $this->assertTrue($statement instanceof MQNDatabaseStatement);
        $statement = null;
        $statement = $o->prepareLimitForUpdate($sql, $row_count, $offset);
        $this->assertTrue($statement instanceof MQNDatabaseStatement);
        $statement = null;
    }

    public function testQuery()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $this->assertFalse($o->query($sql));
    }

    public function testQueryForUpdate()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $this->assertFalse($o->queryForUpdate($sql));
    }

    public function testQueryLimit()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $row_count = 2;
        $offset = 3;
        $this->assertFalse($o->queryLimit($sql, $row_count));
        $this->assertFalse($o->queryLimit($sql, $row_count, $offset));
    }

    public function testQueryLimitForUpdate()
    {
        $o = new MQNDatabase($this->config);
        $sql = 'string';
        $row_count = 2;
        $offset = 3;
        $this->assertFalse($o->queryLimitForUpdate($sql, $row_count));
        $this->assertFalse($o->queryLimitForUpdate($sql, $row_count, $offset));
    }

    public function testRollback()
    {
        $o = new MQNDatabase($this->config);
        $this->assertFalse($o->rollback());
    }

}

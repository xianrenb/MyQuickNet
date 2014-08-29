<?php

/**
 * MQNDatabaseMySQLiTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabaseMySQLi.
 */
class MQNDatabaseMySQLiTest extends \PHPUnit_Framework_TestCase
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
        $config['db_host'] = 'localhost';
        $config['db_port'] = '';
        $config['db_name'] = 'mqntestdb';
        $config['db_user'] = 'mqntestdbuser';
        $config['db_password'] = 'mqntest';
        $config['db_socket'] = '';
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
        $o = new MQNDatabaseMySQLi($this->config);
        $this->assertFalse($o->begin());
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $this->assertTrue($o->begin());
    }

    public function testClose()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $this->assertTrue($o->close());
    }

    public function testCommit()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $this->assertFalse($o->commit());
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $this->assertTrue($o->commit());
    }

    public function testConnect()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $this->assertTrue($o->connect());
    }

    public function testEscapeString()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $a = array(chr(0), "\n", "\r", "\\", "\'", "\"", chr(26));

        foreach ($a as $v) {
            $this->assertNotEquals($v, $o->escapeString($v));
        }
    }

    public function testIsReady()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $this->assertFalse($o->isReady());
        $o->connect();
        $this->assertTrue($o->isReady());
        $o->close();
        $this->assertFalse($o->isReady());
    }

    public function testPrepare()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $o->query($sql);
        $sql = 'SELECT `data` FROM `test` WHERE `data` > ? AND `data` <= ?';
        $statement = $o->prepare($sql);
        $this->assertTrue($statement instanceof MQNDatabaseMySQLiStatement);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(5);
        $result = $statement->execute();
        $statement = null;
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(4, $result[0]['data']);
        $this->assertEquals(5, $result[1]['data']);
    }

    public function testPrepareForUpdate()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $o->query($sql);
        $sql = 'SELECT `data` FROM `test` WHERE `data` > ? AND `data` <= ?';
        $statement = $o->prepareForUpdate($sql);
        $this->assertTrue($statement instanceof MQNDatabaseMySQLiStatement);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(5);
        $result = $statement->execute();
        $statement = null;
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(4, $result[0]['data']);
        $this->assertEquals(5, $result[1]['data']);
    }

    public function testPrepareLimit()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $o->query($sql);
        $sql = 'SELECT `data` FROM `test` WHERE `data` > ? AND `data` <= ?';
        $statement = $o->prepareLimit($sql, 2);
        $this->assertTrue($statement instanceof MQNDatabaseMySQLiStatement);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(6);
        $result = $statement->execute();
        $statement = null;
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(4, $result[0]['data']);
        $this->assertEquals(5, $result[1]['data']);
        $statement = $o->prepareLimit($sql, 2, 1);
        $this->assertTrue($statement instanceof MQNDatabaseMySQLiStatement);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(6);
        $result = $statement->execute();
        $statement = null;
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(5, $result[0]['data']);
        $this->assertEquals(6, $result[1]['data']);
    }

    public function testPrepareLimitForUpdate()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $o->query($sql);
        $sql = 'SELECT `data` FROM `test` WHERE `data` > ? AND `data` <= ?';
        $statement = $o->prepareLimitForUpdate($sql, 2);
        $this->assertTrue($statement instanceof MQNDatabaseMySQLiStatement);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(6);
        $result = $statement->execute();
        $statement = null;
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(4, $result[0]['data']);
        $this->assertEquals(5, $result[1]['data']);
        $statement = $o->prepareLimitForUpdate($sql, 2, 1);
        $this->assertTrue($statement instanceof MQNDatabaseMySQLiStatement);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(6);
        $result = $statement->execute();
        $statement = null;
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(5, $result[0]['data']);
        $this->assertEquals(6, $result[1]['data']);
    }

    public function testQuery()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'SELECT `data` FROM `test`';
        $result = $o->query($sql);
        $this->assertEquals(0, count($result));
    }

    public function testQueryForUpdate()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'SELECT `data` FROM `test`';
        $result = $o->queryForUpdate($sql);
        $this->assertEquals(0, count($result));
    }

    public function testQueryLimit()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $o->query($sql);
        $sql = 'SELECT `data` FROM `test`';
        $rowCount = 2;
        $offset = 3;
        $result = $o->queryLimit($sql, $rowCount);
        $this->assertEquals(2, count($result));
        $this->assertEquals(0, $result[0]['data']);
        $this->assertEquals(1, $result[1]['data']);
        $result = $o->queryLimit($sql, $rowCount, $offset);
        $this->assertEquals(2, count($result));
        $this->assertEquals(3, $result[0]['data']);
        $this->assertEquals(4, $result[1]['data']);
    }

    public function testQueryLimitForUpdate()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $o->query($sql);
        $sql = 'SELECT `data` FROM `test`';
        $rowCount = 2;
        $offset = 3;
        $result = $o->queryLimitForUpdate($sql, $rowCount);
        $this->assertEquals(2, count($result));
        $this->assertEquals(0, $result[0]['data']);
        $this->assertEquals(1, $result[1]['data']);
        $result = $o->queryLimitForUpdate($sql, $rowCount, $offset);
        $this->assertEquals(2, count($result));
        $this->assertEquals(3, $result[0]['data']);
        $this->assertEquals(4, $result[1]['data']);
    }

    public function testRollback()
    {
        $o = new MQNDatabaseMySQLi($this->config);
        $this->assertFalse($o->rollback());
        $o = new MQNDatabaseMySQLi($this->config);
        $o->connect();
        $this->assertTrue($o->rollback());
    }

}

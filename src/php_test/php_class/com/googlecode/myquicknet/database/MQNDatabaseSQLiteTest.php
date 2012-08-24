<?php

/**
 * MQNDatabaseSQLiteTest
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabaseSQLite.
 */
class MQNDatabaseSQLiteTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var array
     */
    private $config;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $config['db_filename'] = (string) (MQN_BASE_PATH . 'sqlite/mqntestdb.sqlite3');
        $this->config = $config;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function testBegin() {
        $o = new MQNDatabaseSQLite($this->config);
        $this->assertFalse($o->begin());
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $this->assertTrue($o->begin());
    }

    public function testClose() {
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $this->assertTrue($o->close());
    }

    public function testCommit() {
        $o = new MQNDatabaseSQLite($this->config);
        $this->assertFalse($o->commit());
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $this->assertTrue($o->commit());
    }

    public function testConnect() {
        $o = new MQNDatabaseSQLite($this->config);
        $this->assertTrue($o->connect());
    }

    public function testEscapeString() {
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $this->assertEquals('abc', $o->escapeString('abc'));
        $this->assertEquals('\'\'abc', $o->escapeString('\'abc'));
        $this->assertEquals('abc\'\'', $o->escapeString('abc\''));
        $this->assertEquals('ab\'\'c', $o->escapeString('ab\'c'));
        $this->assertEquals('?', $o->escapeString('?'));
        $this->assertEquals('?abc', $o->escapeString('?abc'));
        $this->assertEquals(':abc', $o->escapeString(':abc'));
        $this->assertEquals('@abc', $o->escapeString('@abc'));
        $this->assertEquals('$abc', $o->escapeString('$abc'));
        $this->assertEquals('\'\'', $o->escapeString('\''));
        $this->assertEquals('\'\'\'\'', $o->escapeString('\'\''));
        $this->assertEquals('\'\'\'\'\'\'', $o->escapeString('\'\'\''));
    }

    public function testIsReady() {
        $o = new MQNDatabaseSQLite($this->config);
        $this->assertFalse($o->isReady());
        $o->connect();
        $this->assertTrue($o->isReady());
        $o->close();
        $this->assertFalse($o->isReady());
    }

    public function testQuery() {
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $sql = 'SELECT `data` FROM `test`';
        $result = $o->query($sql);
        $this->assertEquals(0, count($result));
    }

    public function testQueryForUpdate() {
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $sql = 'SELECT `data` FROM `test`';
        $result = $o->queryForUpdate($sql);
        $this->assertEquals(0, count($result));
    }

    public function testQueryLimit() {
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();

        for ($i = 0; $i < 10; ++$i) {
            $sql = 'INSERT INTO `test` ( `data` ) VALUES ( ' . (int) $i . ' )';
            $o->query($sql);
        }

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

    public function testQueryLimitForUpdate() {
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();

        for ($i = 0; $i < 10; ++$i) {
            $sql = 'INSERT INTO `test` ( `data` ) VALUES ( ' . (int) $i . ' )';
            $o->query($sql);
        }

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

    public function testRollback() {
        $o = new MQNDatabaseSQLite($this->config);
        $this->assertFalse($o->rollback());
        $o = new MQNDatabaseSQLite($this->config);
        $o->connect();
        $this->assertTrue($o->rollback());
    }

}

?>

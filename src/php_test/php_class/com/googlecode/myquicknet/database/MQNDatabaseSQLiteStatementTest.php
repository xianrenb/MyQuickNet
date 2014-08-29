<?php

/**
 * MQNDatabaseSQLiteStatementTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabaseSQLiteStatement.
 */
class MQNDatabaseSQLiteStatementTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var MQNDatabaseSQLite;
     */
    private $db;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $config = array();
        $config['db_filename'] = (string) (MQN_BASE_PATH . 'sqlite/mqntestdb.sqlite3');
        $this->db = new MQNDatabaseSQLite($config);
        $this->db->connect();

        for ($i = 0; $i < 10; ++$i) {
            $sql = 'INSERT INTO `test` ( `data` ) VALUES ( ' . (int) $i . ' )';
            $this->db->query($sql);
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->db = null;
    }

    public function testExecute()
    {
        $sql = 'SELECT `data` FROM `test` WHERE `data` > ? AND `data` <= ? LIMIT ?';
        $statement = $this->db->prepare($sql);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(6);
        $statement->appendExtraBindValueArray(2);
        $result = $statement->execute();
        $this->assertTrue(is_array($result));
        $this->assertEquals(2, count($result));
        $this->assertEquals(4, $result[0]['data']);
        $this->assertEquals(5, $result[1]['data']);
        $sql = 'SELECT `id` FROM `testing_auto_record` WHERE `my_blob` = ? AND `my_blob` = ?';
        $statement = $this->db->prepare($sql);
        $statement->appendBindValueArray(new MQNBlob(hex2bin('626c6f62')));
        $statement->appendExtraBindValueArray(new MQNBlob(hex2bin('626c6f62')));
        $result = $statement->execute();
        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
        $this->assertEquals(1, $result[0]['id']);
    }

}

<?php

/**
 * MQNDatabaseSQLiteStatementTest
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabaseSQLiteStatement.
 */
class MQNDatabaseSQLiteStatementTest extends \PHPUnit_Framework_TestCase {

    /**
     *
     * @var array
     */
    private $config;

    /**
     *
     * @var MQNDatabaseSQLite;
     */
    private $db;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $config = array();
        $config['db_filename'] = (string) (MQN_BASE_PATH . 'sqlite/mqntestdb.sqlite3');
        $this->db = new MQNDatabaseSQLite($config);
        $this->db->connect();

        for ($i = 0; $i < 10; ++$i) {
            $sql = 'INSERT INTO `test` ( `data` ) VALUES ( ' . (int) $i . ' )';
            $this->db->query($sql);
        }

        $config = array();
        $this->config = $config;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        $this->db = null;
    }

    public function testExecute() {
        $sql = 'SELECT `data` FROM `test` WHERE `data` > ? AND `data` <= ?';
        $statement = $this->db->prepare($sql);
        $statement->appendBindValueArray(3);
        $statement->appendBindValueArray(5);
        $result = $statement->execute();
        $this->assertEquals(2, count($result));
        $this->assertEquals(4, $result[0]['data']);
        $this->assertEquals(5, $result[1]['data']);
    }

}

?>

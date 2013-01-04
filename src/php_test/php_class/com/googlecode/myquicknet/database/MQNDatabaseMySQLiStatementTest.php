<?php

/**
 * MQNDatabaseMySQLiStatementTest
 * @package MyQuickNet
 * @version 4.5
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNDatabaseMySQLiStatement.
 */
class MQNDatabaseMySQLiStatementTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var MQNDatabaseMySQLi;
     */
    private $db;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $config = array();
        $config['db_host'] = 'localhost';
        $config['db_port'] = '';
        $config['db_name'] = 'mqntestdb';
        $config['db_user'] = 'mqntestdbuser';
        $config['db_password'] = 'mqntest';
        $this->db = new MQNDatabaseMySQLi($config);
        $this->db->connect();
        $sql = 'INSERT INTO `test` ( `data` ) VALUES ';

        for ($i = 0; $i < 10; ++$i) {
            $sql .= ( $i > 0) ? ' , ' : '';
            $sql .= '( ' . (int) $i . ' )';
        }

        $this->db->query($sql);
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
    }

}

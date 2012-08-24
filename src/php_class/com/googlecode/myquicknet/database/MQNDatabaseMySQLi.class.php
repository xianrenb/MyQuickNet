<?php

/**
 * MQNDatabaseMySQLi
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 *
 */
class MQNDatabaseMySQLi extends MQNDatabase {

    /**
     *
     * @var bool
     */
    private $closed;

    /**
     *
     * @var string
     */
    private $host;

    /**
     *
     * @var object
     */
    private $mysqli;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var string
     */
    private $password;

    /**
     *
     * @var int|string
     */
    private $port;

    /**
     *
     * @var bool
     */
    private $transactionStarted;

    /**
     *
     * @var string
     */
    private $user;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config) {
        $this->closed = true;
        $this->host = (string) $config['db_host'];
        $this->mysqli = null;
        $this->name = (string) $config['db_name'];
        $this->password = (string) $config['db_password'];
        $this->port = $config['db_port'];

        if ($this->port == '') {
            $this->port = 3306;
        } else {
            $this->port = (int) $this->port;
        }

        $this->transactionStarted = false;
        $this->user = (string) $config['db_user'];
    }

    public function __destruct() {
        $this->close();
    }

    /**
     *
     * @return bool
     */
    public function begin() {
        if ($this->isReady()) {
            $this->transactionStarted = true;
            return true;
        }

        return false;
    }

    /**
     *
     * @return bool
     */
    public function close() {
        if ($this->mysqli) {
            if (!$this->closed) {
                if ($this->transactionStarted) {
                    if (!$this->rollback()) {
                        throw new \Exception('Could not rollback.');
                    }
                }

                $this->closed = (bool) $this->mysqli->close();

                if (!$this->closed) {
                    throw new \Exception('Could not close database: ' . $this->mysqli->error);
                }
            }

            $this->mysqli = null;
        }

        return true;
    }

    /**
     *
     * @return bool
     */
    public function commit() {
        if ($this->isReady() && $this->transactionStarted) {
            $result = (bool) $this->mysqli->commit();
            $this->transactionStarted = false;
            return $result;
        }

        return false;
    }

    /**
     *
     * @return bool
     */
    public function connect() {
        $this->close();
        $this->mysqli = new \mysqli($this->host, $this->user, $this->password, $this->name, $this->port);

        if ($this->mysqli->connect_error) {
            throw new \Exception('Database Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }

        $this->closed = false;
        $this->mysqli->set_charset('utf8');
        $this->query('SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED');
        $this->mysqli->autocommit(false);
        $this->transactionStarted = true;
        return true;
    }

    /**
     *
     * @param string $string
     * @return string
     */
    public function escapeString($string) {
        new \String($string);
        $result = (string) $this->mysqli->real_escape_string($string);
        return $result;
    }

    /**
     *
     * @return bool
     */
    public function isReady() {
        $result = (bool) ($this->mysqli && !$this->closed);
        return $result;
    }

    /**
     *
     * @param string $sql
     * @return array|bool
     */
    public function query($sql) {
        new \String($sql);

        if ($this->mysqli) {
            $result = $this->mysqli->query($sql);
        } else {
            $result = false;
        }

        if (!$result) {
            throw new \Exception('Database query error: ' . $this->mysqli->error);
        }

        if ($result instanceof \mysqli_result) {
            $rowList = array();
            $i = 0;

            while ($row = $result->fetch_assoc()) {
                $rowList[$i] = $row;
                ++$i;
            }

            $result->free();
            return $rowList;
        }

        return true;
    }

    /**
     *
     * @param string $sql
     * @return array|bool
     */
    public function queryForUpdate($sql) {
        new \String($sql);
        $sql = (string) ('' . $sql . ' FOR UPDATE');
        $result = $this->query($sql);
        return $result;
    }

    /**
     *
     * @param string $sql
     * @param int $rowCount
     * @param int $offset
     * @return array|bool
     */
    public function queryLimit($sql, $rowCount, $offset = 0) {
        new \String($sql);
        new \Int($rowCount);
        new \Int($offset);
        $sql = (string) ('' . $sql . ' LIMIT ' . (int) $offset . ' , ' . (int) $rowCount);
        $result = $this->query($sql);
        return $result;
    }

    /**
     *
     * @param string $sql
     * @param int $rowCount
     * @param int $offset
     * @return array|bool
     */
    public function queryLimitForUpdate($sql, $rowCount, $offset = 0) {
        new \String($sql);
        new \Int($rowCount);
        new \Int($offset);
        $sql = (string) ('' . $sql . ' LIMIT ' . (int) $offset . ' , ' . (int) $rowCount . ' FOR UPDATE');
        $result = $this->query($sql);
        return $result;
    }

    /**
     *
     * @return bool
     */
    public function rollback() {
        if ($this->isReady() && $this->transactionStarted) {
            $result = (bool) $this->mysqli->rollback();
            $this->transactionStarted = false;
            return $result;
        }

        return false;
    }

}

?>

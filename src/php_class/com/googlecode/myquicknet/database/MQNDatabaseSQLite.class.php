<?php

/**
 * MQNDatabaseSQLite
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 *
 */
class MQNDatabaseSQLite extends MQNDatabase {

    /**
     *
     * @var bool
     */
    private $closed;

    /**
     *
     * @var string
     */
    private $filename;

    /**
     *
     * @var object
     */
    private $sqlite3;

    /**
     *
     * @var bool
     */
    private $transactionStarted;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config) {
        $this->closed = true;
        $this->filename = (string) $config['db_filename'];
        $this->sqlite3 = null;
        $this->transactionStarted = false;
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
            if (!$this->transactionStarted) {
                $this->query('BEGIN EXCLUSIVE');
                $this->transactionStarted = true;
            }

            return true;
        }

        return false;
    }

    /**
     *
     * @return bool
     */
    public function close() {
        if ($this->sqlite3) {
            if (!$this->closed) {
                if ($this->transactionStarted) {
                    if (!$this->rollback()) {
                        throw new \Exception('Could not rollback.');
                    }
                }

                $this->closed = (bool) $this->sqlite3->close();

                if (!$this->closed) {
                    throw new \Exception('Could not close database.');
                }
            }

            $this->sqlite3 = null;
        }

        return true;
    }

    /**
     *
     * @return bool
     */
    public function commit() {
        if ($this->isReady() && $this->transactionStarted) {
            $this->query('COMMIT');
            $this->transactionStarted = false;
            return true;
        }

        return false;
    }

    /**
     *
     * @return bool
     */
    public function connect() {
        $this->close();
        $this->sqlite3 = new \SQLite3($this->filename);
        $this->closed = false;
        $this->query('BEGIN EXCLUSIVE');
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
        $result = (string) $this->sqlite3->escapeString($string);
        return $result;
    }

    /**
     *
     * @return bool
     */
    public function isReady() {
        $result = (bool) ($this->sqlite3 && !$this->closed);
        return $result;
    }

    /**
     *
     * @param string $sql
     * @return array|bool
     */
    public function query($sql) {
        new \String($sql);

        if (preg_match('/^select/i', $sql)) {
            if ($this->sqlite3) {
                $result = $this->sqlite3->query($sql);
            } else {
                $result = null;
            }

            if (!$result || !($result instanceof \SQLite3Result)) {
                throw new \Exception('Database query error.');
            }

            $rowList = array();
            $i = 0;

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rowList[$i] = $row;
                ++$i;
            }

            $result->finalize();
            return $rowList;
        } else {
            if ($this->sqlite3) {
                $this->sqlite3->busyTimeout(60000);
                $result = (bool) $this->sqlite3->exec($sql);
                $this->sqlite3->busyTimeout(0);
            } else {
                $result = false;
            }

            if (!$result) {
                throw new \Exception('Database query error.');
            }
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
        $result = $this->queryLimit($sql, $rowCount, $offset);
        return $result;
    }

    /**
     *
     * @return bool
     */
    public function rollback() {
        if ($this->isReady() && $this->transactionStarted) {
            $this->query('ROLLBACK');
            $this->transactionStarted = false;
            return true;
        }

        return false;
    }

}

?>

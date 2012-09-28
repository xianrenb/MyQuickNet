<?php

/**
 * MQNDatabaseSQLiteStatement
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

use com\googlecode\myquicknet\autorecord\MQNAutoRecord;

/**
 *
 */
class MQNDatabaseSQLiteStatement extends MQNDatabaseStatement {

    /**
     *
     * @var array
     */
    private $bindValueArray;

    /**
     *
     * @var SQLite3Stmt
     */
    private $statement;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config) {
        $this->bindValueArray = array();
        $this->statement = $config['statement'];
    }

    /**
     * 
     */
    public function __destruct() {
        if ($this->statement) {
            $this->statement->close();
        }
    }

    /**
     * 
     * @param bool|float|int|string|MQNAutoRecord $value
     */
    public function appendBindValueArray($value) {
        if (is_scalar($value)) {
            $this->bindValueArray[] = $value;
        } else if ($value instanceof MQNAutoRecord) {
            $this->bindValueArray[] = (int) $value->getId();
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * 
     * @return array
     */
    public function execute() {
        $i = 1;

        foreach ($this->bindValueArray as $value) {
            if (is_bool($value)) {
                $type = SQLITE3_INTEGER;
                $value = (int) $value;
            } else if (is_float($value)) {
                $type = SQLITE3_FLOAT;
            } else if (is_int($value)) {
                $type = SQLITE3_INTEGER;
            } else if (is_string($value)) {
                $type = SQLITE3_TEXT;
            } else {
                throw new \UnexpectedValueException();
            }

            $this->statement->bindValue($i, $value, $type);
            $i += 1;
        }

        $result = $this->statement->execute();

        if (!$result || !($result instanceof \SQLite3Result)) {
            throw new \Exception('Database statement execute error.');
        }

        $rowList = array();
        $i = 0;

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rowList[$i] = $row;
            ++$i;
        }

        $result->finalize();
        return $rowList;
    }

}

?>

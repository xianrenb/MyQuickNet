<?php

/**
 * MQNDatabaseSQLiteStatement
 * @package MyQuickNet
 * @version 4.0
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
     * @var array
     */
    private $extraBindValueArray;

    /**
     *
     * @var SQLite3Stmt
     */
    private $statement;

    /**
     * 
     * @param \SQLite3Stmt $statement
     */
    public function __construct(\SQLite3Stmt $statement) {
        $this->bindValueArray = array();
        $this->extraBindValueArray = array();
        $this->statement = $statement;
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
     * @throws \InvalidArgumentException
     */
    public function appendBindValueArray($value) {
        if (is_scalar($value) || $value instanceof MQNBlob) {
            $this->bindValueArray[] = $value;
        } else if ($value instanceof MQNAutoRecord) {
            $this->bindValueArray[] = (int) $value->getId();
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * 
     * @param bool|float|int|string|MQNAutoRecord $value
     * @throws \InvalidArgumentException
     */
    public function appendExtraBindValueArray($value) {
        if (is_scalar($value) || $value instanceof MQNBlob) {
            $this->extraBindValueArray[] = $value;
        } else if ($value instanceof MQNAutoRecord) {
            $this->extraBindValueArray[] = (int) $value->getId();
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * 
     * @return array
     * @throws \UnexpectedValueException
     * @throws \Exception
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
            } else if ($value instanceof MQNBlob) {
                $type = SQLITE3_BLOB;
                $value = (string) $value->getBlob();
            } else {
                throw new \UnexpectedValueException();
            }

            $this->statement->bindValue($i, $value, $type);
            $i += 1;
        }

        foreach ($this->extraBindValueArray as $value) {
            if (is_bool($value)) {
                $type = SQLITE3_INTEGER;
                $value = (int) $value;
            } else if (is_float($value)) {
                $type = SQLITE3_FLOAT;
            } else if (is_int($value)) {
                $type = SQLITE3_INTEGER;
            } else if (is_string($value)) {
                $type = SQLITE3_TEXT;
            } else if ($value instanceof MQNBlob) {
                $type = SQLITE3_BLOB;
                $value = (string) $value->getBlob();
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
            $i += 1;
        }

        $result->finalize();
        return $rowList;
    }

}

?>

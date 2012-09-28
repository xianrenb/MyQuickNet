<?php

/**
 * MQNDatabaseMySQLiStatement
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
class MQNDatabaseMySQLiStatement extends MQNDatabaseStatement {

    /**
     *
     * @var array
     */
    private $bindValueArray;

    /**
     *
     * @var mysqli_stmt
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
            if (!$this->statement->close()) {
                throw new \Exception('Could not close database statement.');
            }
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
        $types = '';
        $refBindValueArray = array();
        $bindValueArrayCount = (int) count($this->bindValueArray);

        for ($i = 0; $i < $bindValueArrayCount; ++$i) {
            if (is_bool($this->bindValueArray[$i])) {
                $types .= 'i';
                $this->bindValueArray[$i] = (int) $this->bindValueArray[$i];
            } else if (is_float($this->bindValueArray[$i])) {
                $types .= 'd';
            } else if (is_int($this->bindValueArray[$i])) {
                $types .= 'i';
            } else if (is_string($this->bindValueArray[$i])) {
                $types .= 's';
            } else {
                throw new \UnexpectedValueException();
            }

            $refBindValueArray[] = &$this->bindValueArray[$i];
        }

        $args = array();
        array_push($args, $types);
        $args = array_merge($args, $refBindValueArray);
        call_user_func_array(array($this->statement, 'bind_param'), $args);
        $result = (bool) $this->statement->execute();

        if (!$result) {
            throw new \Exception('Database statement execute error: ' . $this->statement->error);
        }

        $result = $this->statement->get_result();
        $rowList = array();

        if ($result instanceof \mysqli_result) {
            $i = 0;

            while ($row = $result->fetch_assoc()) {
                $rowList[$i] = $row;
                ++$i;
            }

            $result->free();
        }

        return $rowList;
    }

}

?>

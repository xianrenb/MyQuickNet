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
     * @var array
     */
    private $extraBindValueArray;

    /**
     *
     * @var mysqli_stmt
     */
    private $statement;

    /**
     * 
     * @param \mysqli_stmt $statement
     */
    public function __construct(\mysqli_stmt $statement) {
        $this->bindValueArray = array();
        $this->extraBindValueArray = array();
        $this->statement = $statement;
    }

    /**
     * 
     * @throws \Exception
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
     * @return array
     * @throws \UnexpectedValueException
     */
    protected function _getResult() {
        $rowList = array();
        $resultMetaData = $this->statement->result_metadata();

        if ($resultMetaData === false) {
            return $rowList;
        }

        $fieldCount = (int) $resultMetaData->field_count;

        if ($fieldCount) {
            $fields = array();
            $namedFields = array();

            for ($i = 0; $i < $fieldCount; ++$i) {
                $fieldInfo = $resultMetaData->fetch_field();

                if (is_object($fieldInfo)) {
                    $fieldName = (string) $fieldInfo->name;
                    $fields[] = &$namedFields[$fieldName];
                } else {
                    throw new \UnexpectedValueException();
                }
            }

            call_user_func_array(array($this->statement, 'bind_result'), $fields);
            $i = 0;

            while ($this->statement->fetch()) {
                $rowList[$i] = array();

                foreach ($namedFields as $name => $value) {
                    $rowList[$i][$name] = $value;
                }

                $i += 1;
            }
        }

        $resultMetaData->free();
        return $rowList;
    }

    /**
     * 
     * @param bool|float|int|string|MQNAutoRecord $value
     * @throws \InvalidArgumentException
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
     * @param bool|float|int|string|MQNAutoRecord $value
     * @throws \InvalidArgumentException
     */
    public function appendExtraBindValueArray($value) {
        if (is_scalar($value)) {
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

        $extraBindValueArrayCount = (int) count($this->extraBindValueArray);

        for ($i = 0; $i < $extraBindValueArrayCount; ++$i) {
            if (is_bool($this->extraBindValueArray[$i])) {
                $types .= 'i';
                $this->extraBindValueArray[$i] = (int) $this->extraBindValueArray[$i];
            } else if (is_float($this->extraBindValueArray[$i])) {
                $types .= 'd';
            } else if (is_int($this->extraBindValueArray[$i])) {
                $types .= 'i';
            } else if (is_string($this->extraBindValueArray[$i])) {
                $types .= 's';
            } else {
                throw new \UnexpectedValueException();
            }

            $refBindValueArray[] = &$this->extraBindValueArray[$i];
        }

        if ($types !== '') {
            $args = array();
            array_push($args, $types);
            $args = array_merge($args, $refBindValueArray);
            call_user_func_array(array($this->statement, 'bind_param'), $args);
        }

        $result = (bool) $this->statement->execute();

        if (!$result) {
            throw new \Exception('Database statement execute error: ' . $this->statement->error);
        }

        if (method_exists($this->statement, 'get_result')) {
            $result = $this->statement->get_result();
            $rowList = array();

            if ($result instanceof \mysqli_result) {
                $i = 0;

                while ($row = $result->fetch_assoc()) {
                    $rowList[$i] = $row;
                    $i += 1;
                }

                $result->free();
            }
        } else {
            $rowList = $this->_getResult();
        }

        return $rowList;
    }

}

?>

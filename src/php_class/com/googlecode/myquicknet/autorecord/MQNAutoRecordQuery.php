<?php

/**
 * MQNAutoRecordQuery
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 *
 */
class MQNAutoRecordQuery {

    /**
     *
     * @var MQNDatabase
     */
    private $database;

    /**
     *
     * @var array
     */
    private $fieldArray;

    /**
     *
     * @var array
     */
    private $joinConditionArray;

    /**
     *
     * @var int
     */
    private $limitOffset;

    /**
     *
     * @var int
     */
    private $limitRowCount;

    /**
     *
     * @var array
     */
    private $orderArray;

    /**
     *
     * @var array
     */
    private $tableArray;

    /**
     *
     * @var bool
     */
    private $useLimit;

    /**
     *
     * @var array
     */
    private $whereBindValueArray;

    /**
     *
     * @var array
     */
    private $whereConditionArray;

    public function __construct() {
        $this->database = null;
        $this->fieldArray = array();
        $this->joinConditionArray = array();
        $this->limitOffset = 0;
        $this->limitRowCount = 0;
        $this->orderArray = array();
        $this->tableArray = array();
        $this->useLimit = false;
        $this->whereBindValueArray = array();
        $this->whereConditionArray = array();
    }

    public function __destruct() {
        $this->database = null;

        foreach ($this->tableArray as $k => $v) {
            $this->tableArray[$k] = null;
        }
    }

    /**
     *
     * @return string
     */
    protected function _buildJoinConditionSql() {
        $sql = '';
        $n = (int) count($this->joinConditionArray);

        for ($i = 0; $i < $n; ++$i) {
            $sql .= ( $i) ? ' AND ' : ' ON ';
            $field1 = $this->joinConditionArray[$i]->getField1();
            $field2 = $this->joinConditionArray[$i]->getField2();
            $sql .= '`t';
            $sql .= (int) $field1->getTable()->getId();
            $sql .= '`.`';
            $sql .= (string) $field1->getName();
            $sql .= '` = `t';
            $sql .= (int) $field2->getTable()->getId();
            $sql .= '`.`';
            $sql .= (string) $field2->getName();
            $sql .= '`';
        }

        return $sql;
    }

    /**
     *
     * @return string
     */
    protected function _buildOrderSql() {
        $sql = ' ORDER BY ';
        $countOrderArray = (int) count($this->orderArray);

        for ($i = 0; $i < $countOrderArray; ++$i) {
            $sql .= ( $i) ? ' , ' : '';
            $order = $this->orderArray[$i];
            $field = $order->getField();
            $ascending = (bool) $order->isAscending();
            $sql .= '`t';
            $sql .= (int) $field->getTable()->getId();
            $sql .= '`.`';
            $sql .= (string) $field->getName();
            $sql .= '` ';
            $sql .= ( $ascending) ? 'ASC' : 'DESC';
        }

        $countTableArray = (int) count($this->tableArray);

        for ($i = 0; $i < $countTableArray; ++$i) {
            $id = (int) $this->tableArray[$i]->getId();
            $sql .= ( $i || $countOrderArray) ? ' , ' : '';
            $sql .= '`t';
            $sql .= (int) $id;
            $sql .= '`.`id` ASC';
        }

        return $sql;
    }

    /**
     *
     * @return string
     * @throws \Exception 
     */
    protected function _buildWhereConditionSql() {
        $sql = '';
        $countWhereConditionArray = (int) count($this->whereConditionArray);

        if ($countWhereConditionArray) {
            $lastOrNext = false;

            for ($i = 0; $i < $countWhereConditionArray; ++$i) {
                $operator = (string) $this->whereConditionArray[$i]->getOperator();
                $orNext = (bool) $this->whereConditionArray[$i]->getOrNext();
                $value1 = $this->whereConditionArray[$i]->getValue1();
                $value2 = $this->whereConditionArray[$i]->getValue2();

                if ($i) {
                    if ($lastOrNext) {
                        $sql .= ' OR ';
                    } else {
                        $sql .= ' AND ';
                    }
                } else {
                    $sql .= ' WHERE ';
                }

                if (!$lastOrNext && $orNext) {
                    $sql .= '( ';
                }

                if ($value1 instanceof MQNAutoRecordQueryField) {
                    $sql .= '`t';
                    $sql .= (int) $value1->getTable()->getId();
                    $sql .= '`.`valid` = 1 AND ';
                }

                if ($value2 instanceof MQNAutoRecordQueryField) {
                    $sql .= '`t';
                    $sql .= (int) $value2->getTable()->getId();
                    $sql .= '`.`valid` = 1 AND ';
                }

                if ($value1 instanceof MQNAutoRecordQueryField) {
                    $sql .= '`t';
                    $sql .= (int) $value1->getTable()->getId();
                    $sql .= '`.`';
                    $sql .= (string) $value1->getName();
                    $sql .= '`';
                } else {
                    $sql .= '?';
                    $this->whereBindValueArray[] = $value1;
                }

                $sql .= ' ';
                $sql .= (string) $operator;
                $sql .= ' ';

                if ($value2 instanceof MQNAutoRecordQueryField) {
                    $sql .= '`t';
                    $sql .= (int) $value2->getTable()->getId();
                    $sql .= '`.`';
                    $sql .= (string) $value2->getName();
                    $sql .= '`';
                } else {
                    $sql .= '?';
                    $this->whereBindValueArray[] = $value2;
                }

                if ($lastOrNext && !$orNext) {
                    $sql .= ' )';
                }

                $lastOrNext = (bool) $orNext;
            }

            if ($lastOrNext) {
                throw new \Exception('Next condition is expected.');
            }
        } else {
            $countTableArray = (int) count($this->tableArray);

            for ($i = 0; $i < $countTableArray; ++$i) {
                $sql .= ( $i) ? ' AND ' : ' WHERE ';
                $sql .= '`t';
                $sql .= (int) $this->tableArray[$i]->getId();
                $sql .='`.`valid` = 1';
            }
        }

        return $sql;
    }

    /**
     *
     * @param bool|float|int|string|MQNAutoRecordQueryField $value1
     * @param string $operator
     * @param bool|float|int|string|MQNAutoRecordQueryField $value2
     * @param bool $orNext
     * @throws \InvalidArgumentException 
     */
    public function condition($value1, $operator, $value2, $orNext = false) {
        new \String($operator);
        $value1IsField = false;
        $value2IsField = false;

        if (!is_scalar($value1)) {
            if ($value1 instanceof MQNAutoRecordQueryField) {
                $value1IsField = true;
            } else {
                throw new \InvalidArgumentException();
            }
        }

        if (!is_scalar($value2)) {
            if ($value2 instanceof MQNAutoRecordQueryField) {
                $value2IsField = true;
            } else {
                throw new \InvalidArgumentException();
            }
        }

        if (
                ($operator == '=') &&
                $value1IsField &&
                $value2IsField &&
                ($value1->getTable() !== $value2->getTable())
        ) {
            if ($orNext) {
                throw new \InvalidArgumentException();
            }

            $joinCondition = new MQNAutoRecordQueryJoinCondition();
            $joinCondition->setField1($value1);
            $joinCondition->setField2($value2);
            $n = (int) count($this->joinConditionArray);
            $this->joinConditionArray[$n] = $joinCondition;
        } else {
            $whereCondition = new MQNAutoRecordQueryWhereCondition();
            $whereCondition->setOperator($operator);
            $whereCondition->setOrNext($orNext);
            $whereCondition->setValue1($value1);
            $whereCondition->setValue2($value2);
            $n = (int) count($this->whereConditionArray);
            $this->whereConditionArray[$n] = $whereCondition;
        }
    }

    /**
     *
     * @param MQNAutoRecordQueryTable $table
     * @param string $fieldName
     * @return MQNAutoRecordQueryField
     */
    public function field(MQNAutoRecordQueryTable $table, $fieldName) {
        new \String($fieldName);
        $id = (int) count($this->fieldArray);
        $field = new MQNAutoRecordQueryField($id, $fieldName);
        $field->setTable($table);
        $this->fieldArray[$id] = $field;
        return $field;
    }

    /**
     *
     * @param int $rowCount
     * @param int $offset
     */
    public function limit($rowCount, $offset) {
        new \Int($rowCount);
        new \Int($offset);
        $this->useLimit = true;
        $this->limitOffset = (int) $offset;
        $this->limitRowCount = (int) $rowCount;
    }

    /**
     *
     * @return MQNAutoRecordQueryResultArray
     */
    public function execute() {
        $n = (int) count($this->tableArray);
        $sql = 'SELECT ';

        for ($i = 0; $i < $n; ++$i) {
            $id = (int) $this->tableArray[$i]->getId();
            $sql .= ( $i) ? ' , ' : '';
            $sql .= '`t';
            $sql .= (int) $id;
            $sql .= '`.`id`';
            $sql .= ' AS ';
            $sql .= '`id';
            $sql .= (int) $id;
            $sql .= '`';
        }

        $sql .= ' FROM ';

        for ($i = 0; $i < $n; ++$i) {
            $sql .= ( $i) ? ' INNER JOIN ' : '';
            $sql .= '`';
            $sql .= (string) $this->tableArray[$i]->getName();
            $sql .= '` AS `t';
            $sql .= (int) $this->tableArray[$i]->getId();
            $sql .= '`';
        }

        $sql .= (string) $this->_buildJoinConditionSql();
        $sql .= (string) $this->_buildWhereConditionSql();
        $sql .= (string) $this->_buildOrderSql();

        if ($this->useLimit) {
            $statement = $this->database->prepareLimitForUpdate($sql, $this->limitRowCount, $this->limitOffset);
        } else {
            $statement = $this->database->prepareForUpdate($sql);
        }

        foreach ($this->whereBindValueArray as $value) {
            $statement->appendBindValueArray($value);
        }

        $result = $statement->execute();
        $statement = null;
        $resultArray = new MQNAutoRecordQueryResultArray();
        $resultArray->setResultArray($result);
        return $resultArray;
    }

    /**
     *
     * @param MQNAutoRecordQueryField $field
     * @param bool $ascending
     */
    public function order(MQNAutoRecordQueryField $field, $ascending = true) {
        new \Bool($ascending);
        $order = new MQNAutoRecordQueryOrder();
        $order->setAscending($ascending);
        $order->setField($field);
        $n = (int) count($this->orderArray);
        $this->orderArray[$n] = $order;
    }

    /**
     *
     * @param string $autoRecordClassName
     * @return MQNAutoRecordQueryTable
     * @throws \InvalidArgumentException 
     */
    public function table($autoRecordClassName) {
        new \String($autoRecordClassName);
        $autoRecord = new $autoRecordClassName();

        if ($this->database) {
            if ($this->database != $autoRecord->getDatabase()) {
                throw new \InvalidArgumentException();
            }
        } else {
            $this->database = $autoRecord->getDatabase();
        }

        $id = (int) count($this->tableArray);
        $table = new MQNAutoRecordQueryTable($id, $autoRecord->getTable());
        $table->setAutoRecord($autoRecord);
        $table->setAutoRecordClassName($autoRecordClassName);
        $this->tableArray[$id] = $table;
        return $table;
    }

}

?>

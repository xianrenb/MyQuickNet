<?php

/**
 * MQNAutoRecordQuery
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

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
     */
    protected function _buildWhereConditionSql() {
        $sql = '';
        $n = (int) count($this->whereConditionArray);

        for ($i = 0; $i < $n; ++$i) {
            $sql .= ( $i) ? ' AND ' : ' WHERE ';
            $operator = (string) $this->whereConditionArray[$i]->getOperator();
            $value1 = $this->whereConditionArray[$i]->getValue1();
            $value2 = $this->whereConditionArray[$i]->getValue2();

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
            } else if (is_bool($value1)) {
                $sql .= (int) $value1;
            } else if (is_float($value1)) {
                $sql .= (float) $value1;
            } else if (is_int($value1)) {
                $sql .= (int) $value1;
            } else if (is_string($value1)) {
                $sql .= '\'';
                $sql .= (string) $this->database->escapeString($value1);
                $sql .= '\'';
            } else {
                throw new Exception('Type not supported.');
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
            } else if (is_bool($value2)) {
                $sql .= (int) $value2;
            } else if (is_float($value2)) {
                $sql .= (float) $value2;
            } else if (is_int($value2)) {
                $sql .= (int) $value2;
            } else if (is_string($value2)) {
                $sql .= '\'';
                $sql .= (string) $this->database->escapeString($value2);
                $sql .= '\'';
            } else {
                throw new Exception('Type not supported.');
            }
        }

        return $sql;
    }

    /**
     *
     * @param bool|float|int|string|MQNAutoRecordQueryField $value1
     * @param string $operator
     * @param bool|float|int|string|MQNAutoRecordQueryField $value2
     */
    public function condition($value1, $operator, $value2) {
        new String($operator);
        $value1IsField = false;
        $value2IsField = false;

        if (!is_scalar($value1)) {
            if ($value1 instanceof MQNAutoRecordQueryField) {
                $value1IsField = true;
            } else {
                throw new InvalidArgumentException();
            }
        }

        if (!is_scalar($value2)) {
            if ($value2 instanceof MQNAutoRecordQueryField) {
                $value2IsField = true;
            } else {
                throw new InvalidArgumentException();
            }
        }

        if (
                ($operator == '=') &&
                $value1IsField &&
                $value2IsField &&
                ($value1->getTable() !== $value2->getTable())
        ) {
            $joinCondition = new MQNAutoRecordQueryJoinCondition();
            $joinCondition->setField1($value1);
            $joinCondition->setField2($value2);
            $n = (int) count($this->joinConditionArray);
            $this->joinConditionArray[$n] = $joinCondition;
        } else {
            $whereCondition = new MQNAutoRecordQueryWhereCondition();
            $whereCondition->setOperator($operator);
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
        new String($fieldName);
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
        new Int($rowCount);
        new Int($offset);
        $this->useLimit = true;
        $this->limitOffset = (int) $offset;
        $this->limitRowCount = (int) $rowCount;
    }

    /**
     *
     * @return MQNAutoRecordQueryResultArray
     */
    public function execute() {
        $resultArray = new MQNAutoRecordQueryResultArray();
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
            $resultArray->setResultArray($this->database->queryLimitForUpdate($sql, $this->limitRowCount, $this->limitOffset));
        } else {
            $resultArray->setResultArray($this->database->queryForUpdate($sql));
        }

        return $resultArray;
    }

    /**
     *
     * @param MQNAutoRecordQueryField $field
     * @param bool $ascending
     */
    public function order(MQNAutoRecordQueryField $field, $ascending = true) {
        new Bool($ascending);
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
     */
    public function table($autoRecordClassName) {
        new String($autoRecordClassName);
        $autoRecord = new $autoRecordClassName();

        if ($this->database) {
            if ($this->database != $autoRecord->getDatabase()) {
                throw new InvalidArgumentException();
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

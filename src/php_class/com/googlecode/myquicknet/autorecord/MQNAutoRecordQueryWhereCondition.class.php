<?php

/**
 * MQNAutoRecordQueryWhereCondition
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
class MQNAutoRecordQueryWhereCondition extends MQNAutoRecordQueryResource {

    /**
     *
     * @var string
     */
    private $operator;

    /**
     *
     * @var bool|float|int|string|MQNAutoRecordQueryField
     */
    private $value1;

    /**
     *
     * @var bool|float|int|string|MQNAutoRecordQueryField
     */
    private $value2;

    /**
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new Int($id);
        new String($name);
        parent::__construct($id, $name);
        $this->operator = '';
        $this->value1 = null;
        $this->value2 = null;
    }

    /**
     *
     * @return string
     */
    public function getOperator() {
        return $this->operator;
    }

    /**
     *
     * @return bool|float|int|string|MQNAutoRecordQueryField
     */
    public function getValue1() {
        return $this->value1;
    }

    /**
     *
     * @return bool|float|int|string|MQNAutoRecordQueryField
     */
    public function getValue2() {
        return $this->value2;
    }

    /**
     *
     * @param string $operator
     */
    public function setOperator($operator) {
        new String($operator);
        $this->operator = (string) $operator;
    }

    /**
     *
     * @param bool|float|int|string|MQNAutoRecordQueryField $value
     */
    public function setValue1($value) {
        if (!is_scalar($value)) {
            if (!($value instanceof MQNAutoRecordQueryField)) {
                throw new InvalidArgumentException();
            }
        }

        $this->value1 = $value;
    }

    /**
     *
     * @param bool|float|int|string|MQNAutoRecordQueryField $value
     */
    public function setValue2($value) {
        if (!is_scalar($value)) {
            if (!($value instanceof MQNAutoRecordQueryField)) {
                throw new InvalidArgumentException();
            }
        }

        $this->value2 = $value;
    }

}

?>
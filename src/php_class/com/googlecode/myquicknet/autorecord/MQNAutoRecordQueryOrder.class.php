<?php

/**
 * MQNAutoRecordQueryOrder
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 *
 */
class MQNAutoRecordQueryOrder extends MQNAutoRecordQueryResource {

    /**
     *
     * @var bool
     */
    private $ascending;

    /**
     *
     * @var MQNAutoRecordQueryField
     */
    private $field;

    /**
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new \Int($id);
        new \String($name);
        parent::__construct($id, $name);
        $this->ascending = true;
        $this->field = null;
    }

    /**
     *
     * @return MQNAutoRecordQueryField
     */
    public function getField() {
        return $this->field;
    }

    /**
     *
     * @return bool
     */
    public function isAscending() {
        return $this->ascending;
    }

    /**
     *
     * @param bool $ascending
     */
    public function setAscending($ascending) {
        new \Bool($ascending);
        $this->ascending = (bool) $ascending;
    }

    /**
     *
     * @param MQNAutoRecordQueryField $field
     */
    public function setField(MQNAutoRecordQueryField $field) {
        $this->field = $field;
    }

}

?>

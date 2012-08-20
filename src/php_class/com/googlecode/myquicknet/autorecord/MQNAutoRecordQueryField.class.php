<?php

/**
 * MQNAutoRecordQueryField
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 *
 */
class MQNAutoRecordQueryField extends MQNAutoRecordQueryResource {

    /**
     *
     * @var MQNAutoRecordQueryTable
     */
    private $table;

    /**
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new \Int($id);
        new \String($name);
        parent::__construct($id, $name);
        $this->table = null;
    }

    /**
     *
     * @return MQNAutoRecordQueryTable
     */
    public function getTable() {
        return $this->table;
    }

    /**
     *
     * @param MQNAutoRecordQueryTable $table
     */
    public function setTable(MQNAutoRecordQueryTable $table) {
        $this->table = $table;
    }

}

?>

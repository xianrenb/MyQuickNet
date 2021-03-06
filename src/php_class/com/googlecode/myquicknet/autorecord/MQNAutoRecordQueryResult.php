<?php

/**
 * MQNAutoRecordQueryResult
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\scalar\Int;
use com\googlecode\myquicknet\scalar\String;

/**
 *
 */
class MQNAutoRecordQueryResult extends MQNAutoRecordQueryResource
{
    /**
     *
     * @var array
     */
    private $result;

    /**
     *
     * @param int    $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '')
    {
        new Int($id);
        new String($name);
        parent::__construct($id, $name);
        $this->result = array();
    }

    /**
     *
     * @param  MQNAutoRecordQueryTable $table
     * @return autoRecordClassName
     */
    public function getAutoRecord(MQNAutoRecordQueryTable $table)
    {
        $autoRecordClassName = (string) $table->getAutoRecordClassName();
        $autoRecord = new $autoRecordClassName();
        $autoRecord->read($this->getAutoRecordId($table));

        return $autoRecord;
    }

    /**
     *
     * @param  MQNAutoRecordQueryTable $table
     * @return int
     */
    public function getAutoRecordId(MQNAutoRecordQueryTable $table)
    {
        $tableId = (int) $table->getId();
        $autoRecordId = (int) $this->result['id' . $tableId];

        return $autoRecordId;
    }

    /**
     *
     * @param array $result
     */
    public function setResult(array $result)
    {
        $this->result = $result;
    }

}

<?php

/**
 * MQNAutoRecordQueryField
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
class MQNAutoRecordQueryField extends MQNAutoRecordQueryResource
{
    /**
     *
     * @var MQNAutoRecordQueryTable
     */
    private $table;

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
        $this->table = null;
    }

    /**
     *
     * @return MQNAutoRecordQueryTable
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     *
     * @param MQNAutoRecordQueryTable $table
     */
    public function setTable(MQNAutoRecordQueryTable $table)
    {
        $this->table = $table;
    }

}

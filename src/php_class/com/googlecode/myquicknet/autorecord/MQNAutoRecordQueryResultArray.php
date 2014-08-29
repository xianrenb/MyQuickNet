<?php

/**
 * MQNAutoRecordQueryResultArray
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
class MQNAutoRecordQueryResultArray extends MQNAutoRecordQueryResource implements \Iterator
{
    /**
     *
     * @var int
     */
    private $index;

    /**
     *
     * @var array
     */
    private $resultArray;

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
        $this->index = 0;
        $this->resultArray = array();
    }

    /**
     *
     * @return int
     */
    public function count()
    {
        $n = (int) count($this->resultArray);

        return $n;
    }

    /**
     *
     * @return MQNAutoRecordQueryResult
     */
    public function current()
    {
        $result = new MQNAutoRecordQueryResult();
        $result->setResult($this->resultArray[$this->index]);

        return $result;
    }

    /**
     *
     * @return int
     */
    public function key()
    {
        $key = (int) $this->index;

        return $key;
    }

    /**
     *
     */
    public function next()
    {
        $this->index += 1;
    }

    /**
     *
     * @return MQNAutoRecordResult
     */
    public function nextResult()
    {
        if ($this->index >= count($this->resultArray)) {
            return null;
        }

        $result = new MQNAutoRecordQueryResult();
        $result->setResult($this->resultArray[$this->index]);
        $this->index += 1;

        return $result;
    }

    /**
     *
     */
    public function rewind()
    {
        if ($this->index) {
            throw new \Exception('Could not rewind.');
        }
    }

    /**
     *
     * @param array $resultArray
     */
    public function setResultArray(array $resultArray)
    {
        $this->resultArray = $resultArray;
    }

    /**
     *
     * @return bool
     */
    public function valid()
    {
        $valid = (bool) array_key_exists($this->index, $this->resultArray);

        return $valid;
    }

}

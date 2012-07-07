<?php

/**
 * MQNAutoRecordQueryResultArray
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
class MQNAutoRecordQueryResultArray extends MQNAutoRecordQueryResource {

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
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new Int($id);
        new String($name);
        parent::__construct($id, $name);
        $this->index = 0;
        $this->resultArray = array();
    }

    /**
     *
     * @return MQNAutoRecordResult
     */
    public function nextResult() {
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
     * @param array $resultArray
     */
    public function setResultArray(array $resultArray) {
        $this->resultArray = $resultArray;
    }

    /**
     *
     * @return int
     */
    public function count() {
        $n = (int) count($this->resultArray);
        return $n;
    }

}

?>

<?php

/**
 * MQNAutoRecordQueryTable
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class MQNAutoRecordQueryTable extends MQNAutoRecordQueryResource {

    /**
     *
     * @var MQNAutoRecord
     */
    private $autoRecord;

    /**
     *
     * @var string
     */
    private $autoRecordClassName;

    /**
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new Int($id);
        new String($name);
        parent::__construct($id, $name);
        $this->autoRecord = null;
        $this->autoRecordClassName = '';
    }

    public function __destruct() {
        $this->autoRecord = null;
    }

    /**
     *
     * @return string
     */
    public function getAutoRecordClassName() {
        return $this->autoRecordClassName;
    }

    /**
     *
     * @param MQNAutoRecord $autoRecord
     */
    public function setAutoRecord(MQNAutoRecord $autoRecord) {
        $this->autoRecord = $autoRecord;
    }

    /**
     *
     * @param string $autoRecordClassName
     */
    public function setAutoRecordClassName($autoRecordClassName) {
        new String($autoRecordClassName);
        $this->autoRecordClassName = (string) $autoRecordClassName;
    }

}

?>

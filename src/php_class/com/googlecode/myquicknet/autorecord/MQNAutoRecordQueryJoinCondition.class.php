<?php

/**
 * MQNAutoRecordQueryJoinCondition
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
class MQNAutoRecordQueryJoinCondition extends MQNAutoRecordQueryResource {

    /**
     *
     * @var MQNAutoRecordQueryField
     */
    private $field1;

    /**
     *
     * @var MQNAutoRecordQueryField
     */
    private $field2;

    /**
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new Int($id);
        new String($name);
        parent::__construct($id, $name);
        $this->field1 = null;
        $this->field2 = null;
    }

    /**
     *
     * @return MQNAutoRecordQueryField
     */
    public function getField1() {
        return $this->field1;
    }

    /**
     *
     * @return MQNAutoRecordQueryField
     */
    public function getField2() {
        return $this->field2;
    }

    /**
     *
     * @param MQNAutoRecordQueryField $field
     */
    public function setField1(MQNAutoRecordQueryField $field) {
        $this->field1 = $field;
    }

    /**
     *
     * @param MQNAutoRecordQueryField $field
     */
    public function setField2(MQNAutoRecordQueryField $field) {
        $this->field2 = $field;
    }

}

?>

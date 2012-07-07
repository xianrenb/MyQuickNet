<?php

/**
 * MQNAutoRecordQueryOrder
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
        new Int($id);
        new String($name);
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
        new Bool($ascending);
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

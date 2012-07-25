<?php

/**
 * MQNAutoRecordQueryField
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

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
        new Int($id);
        new String($name);
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

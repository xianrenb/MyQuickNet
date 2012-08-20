<?php

/**
 * MQNAutoRecordQueryResource
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 *
 */
class MQNAutoRecordQueryResource {

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id = 0, $name = '') {
        new \Int($id);
        new \String($name);
        $this->id = (int) $id;
        $this->name = (string) $name;
    }

    /**
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

}

?>

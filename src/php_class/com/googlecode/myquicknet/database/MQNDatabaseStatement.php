<?php

/**
 * MQNDatabaseStatement
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 *
 */
class MQNDatabaseStatement
{
    /**
     *
     * @param mixed $statement
     */
    public function __construct($statement)
    {
    }

    /**
     *
     * @param bool|float|int|string|MQNAutoRecord $value
     */
    public function appendBindValueArray($value)
    {
    }

    /**
     *
     * @param bool|float|int|string|MQNAutoRecord $value
     */
    public function appendExtraBindValueArray($value)
    {
    }

    /**
     *
     * @return array
     */
    public function execute()
    {
        return array();
    }

}

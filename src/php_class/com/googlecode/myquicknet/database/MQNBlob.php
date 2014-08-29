<?php

/**
 * MQNBlob
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

use com\googlecode\myquicknet\scalar\String;

/**
 *
 */
class MQNBlob
{
    /**
     *
     * @var string
     */
    private $blob;

    /**
     *
     * @param string $blob
     */
    public function __construct($blob)
    {
        new String($blob);
        $this->blob = (string) $blob;
    }

    /**
     *
     * @return string
     */
    public function getBlob()
    {
        return $this->blob;
    }

}

<?php

/**
 * String
 * @package MyQuickNet
 * @version 4.5
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 *
 */
class String extends Scalar
{
    /**
     *
     * @param string $v
     */
    public function __construct($v)
    {
        if (is_string($v)) {
            parent::__construct($v);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     *
     * @param  mixed  $v
     * @return String
     */
    public static function parse($v)
    {
        $v = strval($v);

        return new String($v);
    }

}

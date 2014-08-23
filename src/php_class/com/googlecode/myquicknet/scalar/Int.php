<?php

/**
 * Int
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 *
 */
class Int extends Scalar
{
    /**
     *
     * @param int $v
     */
    public function __construct($v)
    {
        if (is_int($v)) {
            parent::__construct($v);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     *
     * @param  mixed $v
     * @return Int
     */
    public static function parse($v)
    {
        $v = intval($v);

        return new Int($v);
    }

}

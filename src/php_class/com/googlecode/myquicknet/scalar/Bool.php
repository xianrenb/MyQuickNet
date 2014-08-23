<?php

/**
 * Bool
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 *
 */
class Bool extends Scalar
{
    /**
     *
     * @param bool $v
     */
    public function __construct($v)
    {
        if (is_bool($v)) {
            parent::__construct($v);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     *
     * @param  mixed $v
     * @return Bool
     */
    public static function parse($v)
    {
        $v = (bool) $v;

        return new Bool($v);
    }

}

<?php

/**
 * Float
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 *
 */
class Float extends Scalar
{
    /**
     *
     * @param float $v
     */
    public function __construct($v)
    {
        if (is_float($v)) {
            parent::__construct($v);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     *
     * @param  mixed $v
     * @return Float
     */
    public static function parse($v)
    {
        $v = floatval($v);

        return new Float($v);
    }

}

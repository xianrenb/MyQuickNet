<?php

/**
 * Int
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class Int extends Scalar {

    /**
     *
     * @param int $v
     */
    public function __construct($v) {
        if (is_int($v)) {
            parent::__construct($v);
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     *
     * @param mixed $v
     * @return Int
     */
    public static function parse($v) {
        $v = intval($v);
        return new Int($v);
    }

}

?>

<?php

/**
 * String
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class String extends Scalar {

    /**
     *
     * @param string $v
     */
    public function __construct($v) {
        if (is_string($v)) {
            parent::__construct($v);
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     *
     * @param mixed $v
     * @return String
     */
    public static function parse($v) {
        $v = strval($v);
        return new String($v);
    }

}

?>

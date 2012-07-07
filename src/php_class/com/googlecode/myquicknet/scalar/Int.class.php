<?php

/**
 * Int
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
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

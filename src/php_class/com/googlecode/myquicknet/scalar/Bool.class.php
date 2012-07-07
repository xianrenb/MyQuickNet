<?php

/**
 * Bool
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class Bool extends Scalar {

    /**
     *
     * @param bool $v
     */
    public function __construct($v) {
        if (is_bool($v)) {
            parent::__construct($v);
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     *
     * @param mixed $v
     * @return Bool
     */
    public static function parse($v) {
        $v = (bool) $v;
        return new Bool($v);
    }

}

?>

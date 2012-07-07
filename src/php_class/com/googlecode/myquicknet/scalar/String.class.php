<?php

/**
 * String
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
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

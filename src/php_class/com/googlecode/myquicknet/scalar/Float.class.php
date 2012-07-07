<?php

/**
 * Float
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class Float extends Scalar {

    /**
     *
     * @param float $v
     */
    public function __construct($v) {
        if (is_float($v)) {
            parent::__construct($v);
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     *
     * @param mixed $v
     * @return Float
     */
    public static function parse($v) {
        $v = floatval($v);
        return new Float($v);
    }

}

?>

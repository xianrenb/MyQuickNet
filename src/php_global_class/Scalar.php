<?php

/**
 * Scalar
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class Scalar {

    /**
     *
     * @var mixed
     */
    private $value;

    /**
     *
     * @param mixed $v
     */
    public function __construct($v) {
        $this->value = $v;
    }

    /**
     *
     * @return string
     */
    public function __toString() {
        $v = strval($this->value);
        return $v;
    }

    /**
     *
     * @return bool
     */
    public function toBool() {
        $v = (bool) $this->value;
        return $v;
    }

    /**
     *
     * @return float
     */
    public function toFloat() {
        $v = floatval($this->value);
        return $v;
    }

    /**
     *
     * @return int
     */
    public function toInt() {
        $v = intval($this->value);
        return $v;
    }

    /**
     *
     * @return string
     */
    public function toString() {
        $v = strval($this->value);
        return $v;
    }

}

?>

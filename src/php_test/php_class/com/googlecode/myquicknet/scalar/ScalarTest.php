<?php

/**
 * ScalarTest
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 * Test class for Scalar.
 */
class ScalarTest extends \PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test__toString() {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $o = new Scalar($v);
            $this->assertEquals(strval($v), $o->__toString());
        }
    }

    public function testToBool() {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $o = new Scalar($v);
            $this->assertEquals((bool) $v, $o->toBool());
        }
    }

    public function testToFloat() {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $o = new Scalar($v);
            $this->assertEquals(floatval($v), $o->toFloat());
        }
    }

    public function testToInt() {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $o = new Scalar($v);
            $this->assertEquals(intval($v), $o->toInt());
        }
    }

    public function testToString() {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $o = new Scalar($v);
            $this->assertEquals(strval($v), $o->toString());
        }
    }

}

?>

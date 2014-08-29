<?php

/**
 * FloatTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 * Test class for Float.
 */
class FloatTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        try {
            new Float(true);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
        try {
            new Float(2.2);
        } catch (\Exception $e) {
            $this->fail();
        }
        try {
            new Float(2);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
        try {
            new Float('string');
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testParse()
    {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $this->assertEquals(floatval($v), Float::parse($v)->toFloat());
        }
    }

}

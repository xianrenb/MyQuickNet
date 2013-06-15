<?php

/**
 * IntTest
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 * Test class for Int.
 */
class IntTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        try {
            new Int(true);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
        try {
            new Int(2.2);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
        try {
            new Int(2);
        } catch (\Exception $e) {
            $this->fail();
        }
        try {
            new Int('string');
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
            $this->assertEquals(intval($v), Int::parse($v)->toInt());
        }
    }

}

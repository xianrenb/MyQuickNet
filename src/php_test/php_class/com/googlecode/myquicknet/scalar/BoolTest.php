<?php

/**
 * BoolTest
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\scalar;

/**
 * Test class for Bool.
 */
class BoolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        try {
            new Bool(true);
        } catch (\Exception $e) {
            $this->fail();
        }
        try {
            new Bool(2.2);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
        try {
            new Bool(2);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        }
        try {
            new Bool('string');
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
            $this->assertEquals((bool) $v, Bool::parse($v)->toBool());
        }
    }

}

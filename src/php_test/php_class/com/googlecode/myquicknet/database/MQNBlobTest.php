<?php

/**
 * MQNBlobTest
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\database;

/**
 * Test class for MQNBlob.
 */
class MQNBlobTest extends \PHPUnit_Framework_TestCase {

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

    public function test1() {
        $blob = new MQNBlob('blob');
        $this->assertTrue($blob instanceof MQNBlob);
        $actual = $blob->getBlob();
        $expected = 'blob';
        $this->assertEquals($expected, $actual);
    }

}

?>

<?php

/**
 * StringTest
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 * Test class for String.
 */
class StringTest extends PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        try {
            new String(true);
            $this->fail();
        } catch (InvalidArgumentException $e) {
            
        }
        try {
            new String(2.2);
            $this->fail();
        } catch (InvalidArgumentException $e) {
            
        }
        try {
            new String(2);
            $this->fail();
        } catch (InvalidArgumentException $e) {
            
        }
        try {
            new String('string');
        } catch (Exception $e) {
            $this->fail();
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function testParse() {
        $a = array(true, false, 2.2, 0.0, 2, 0, 'string', '');

        foreach ($a as $v) {
            $this->assertEquals(strval($v), String::parse($v)->toString());
        }
    }

}

?>

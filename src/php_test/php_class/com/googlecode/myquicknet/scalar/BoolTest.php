<?php

/**
 * BoolTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 * Test class for Bool.
 */
class BoolTest extends PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        try {
            new Bool(true);
        } catch (Exception $e) {
            $this->fail();
        }
        try {
            new Bool(2.2);
            $this->fail();
        } catch (InvalidArgumentException $e) {
            
        }
        try {
            new Bool(2);
            $this->fail();
        } catch (InvalidArgumentException $e) {
            
        }
        try {
            new Bool('string');
            $this->fail();
        } catch (InvalidArgumentException $e) {
            
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
            $this->assertEquals((bool) $v, Bool::parse($v)->toBool());
        }
    }

}

?>

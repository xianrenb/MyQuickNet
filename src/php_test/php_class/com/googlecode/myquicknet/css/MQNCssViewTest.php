<?php

/**
 * MQNCssViewTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 * Test class for MQNCssView.
 */
class MQNCssViewTest extends PHPUnit_Framework_TestCase {

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
        $view = new MQNCssView();
        $this->assertTrue($view instanceof MQNCssView);
        ob_start();
        $this->assertTrue($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test2() {
        $view = new MQNCssView();
        $this->assertTrue($view instanceof MQNCssView);
        ob_start();
        $this->assertTrue($view->outputReset());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test3() {
        $view = new MQNCssView();
        $this->assertTrue($view instanceof MQNCssView);
        ob_start();
        $this->assertTrue($view->outputGrid());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/grid.css');
        $this->assertEquals($expected, $actual);
    }

}

?>

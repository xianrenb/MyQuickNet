<?php

/**
 * MQNStaticFileViewTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 * Test class for MQNStaticFileView.
 */
class MQNStaticFileViewTest extends PHPUnit_Framework_TestCase {

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
        $view = new MQNStaticFileView();
        $this->assertTrue($view instanceof MQNStaticFileView);
        ob_start();
        $this->assertFalse($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
    }

    public function test2() {
        $view = new MQNStaticFileView();
        $this->assertTrue($view instanceof MQNStaticFileView);
        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . '/html/default.html');
        $this->assertEquals($expected, $actual);
    }

}

?>

<?php

/**
 * MQNViewTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 * Test class for MQNView.
 */
class MQNViewTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var MQNView
     */
    private $testingViewClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->testingViewClass = 'TestingView';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $view = new $this->testingViewClass();
        $this->assertTrue($view instanceof MQNView);
        $view->setHTMLFileName(MQN_BASE_PATH . '/html/default.html');
        ob_start();
        $this->assertTrue($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . '/html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test2() {
        $view = new $this->testingViewClass();
        $this->assertTrue($view instanceof MQNView);
        $view->setJSONString(json_encode(array('abc' => 123)));
        ob_start();
        $this->assertTrue($view->outputJSON());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) json_encode(array('abc' => 123));
        $this->assertEquals($expected, $actual);
    }

    public function test3() {
        $view = new $this->testingViewClass();
        $this->assertTrue($view instanceof MQNView);
        $view->setHTMLFileName(MQN_BASE_PATH . '/html/default.html');
        ob_start();
        $this->assertTrue($view->outputHTML());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . '/html/default.html');
        $this->assertEquals($expected, $actual);
    }

}

?>

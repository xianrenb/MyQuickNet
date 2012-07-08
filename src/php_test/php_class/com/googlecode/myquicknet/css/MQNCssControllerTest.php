<?php

/**
 * MQNCssControllerTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 * Test class for MQNCssController.
 */
class MQNCssControllerTest extends PHPUnit_Framework_TestCase {

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
        $controller = new MQNCssController();
        $this->assertTrue($controller instanceof MQNCssController);
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test2() {
        $controller = new TestingCssController();
        $this->assertTrue($controller instanceof MQNCssController);
        $_SERVER['PATH_INFO'] = (string) $controller->getUrlBasePath() . 'testing_css/reset.css';
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(dirname(__FILE__) . '/reset.css');
        $this->assertEquals($expected, $actual);
        unset($_SERVER['PATH_INFO']);
    }

    public function test3() {
        $controller = new TestingCssController();
        $this->assertTrue($controller instanceof MQNCssController);
        $_SERVER['PATH_INFO'] = (string) $controller->getUrlBasePath() . 'testing_css/grid.css';
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(dirname(__FILE__) . '/grid.css');
        $this->assertEquals($expected, $actual);
        unset($_SERVER['PATH_INFO']);
    }

}

?>

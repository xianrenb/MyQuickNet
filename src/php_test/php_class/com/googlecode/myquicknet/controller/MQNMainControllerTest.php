<?php

/**
 * MQNMainControllerTest
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 * Test class for MQNMainController.
 */
class MQNMainControllerTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var MQNMainController
     */
    private $testingMainControllerClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->testingMainControllerClass = 'TestingMainController';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $controller = new MQNMainController();
        $this->assertTrue($controller instanceof MQNMainController);
        $this->isNull($controller->getModel());
        $this->assertEquals('/', $controller->getUrlBasePath());
        $this->assertTrue($controller->getView() instanceof MQNView);
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test2() {
        $controller = new $this->testingMainControllerClass();
        $this->assertTrue($controller instanceof MQNMainController);
        $this->isNull($controller->getModel());
        $this->assertEquals('/MyQuickNet/', $controller->getUrlBasePath());
        $this->isNull($controller->getView());
    }

}

?>

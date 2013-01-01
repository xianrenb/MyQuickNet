<?php

/**
 * MQNControllerTest
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\controller;

use com\googlecode\myquicknet\view\MQNView;
use com\googlecode\myquicknet\testing\TestingAutoRecordCache;
use com\googlecode\myquicknet\testing\TestingView;

/**
 * Test class for MQNController.
 */
class MQNControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var MQNController
     */
    private $testingControllerClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->testingControllerClass = '\\com\\googlecode\\myquicknet\\testing\\TestingController';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function test1()
    {
        $controller = new MQNController();
        $this->assertTrue($controller instanceof MQNController);
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

    public function test2()
    {
        $controller = new $this->testingControllerClass();
        $this->assertTrue($controller instanceof MQNController);
        $this->assertTrue($controller->getModel() instanceof TestingAutoRecordCache);
        $this->assertEquals('/MyQuickNet/', $controller->getUrlBasePath());
        $this->assertTrue($controller->getView() instanceof TestingView);
    }

}

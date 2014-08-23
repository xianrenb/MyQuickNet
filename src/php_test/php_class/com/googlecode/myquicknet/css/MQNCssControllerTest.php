<?php

/**
 * MQNCssControllerTest
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\css;

use com\googlecode\myquicknet\testing\TestingCssController;

/**
 * Test class for MQNCssController.
 */
class MQNCssControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
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
        $controller = new MQNCssController();
        $this->assertTrue($controller instanceof MQNCssController);
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test2()
    {
        $controller = new TestingCssController();
        $this->assertTrue($controller instanceof MQNCssController);
        $_SERVER['PATH_INFO'] = (string) $controller->getUrlBasePath() . 'testing_css/reset.css';
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
        unset($_SERVER['PATH_INFO']);
    }

    public function test3()
    {
        $controller = new TestingCssController();
        $this->assertTrue($controller instanceof MQNCssController);
        $_SERVER['PATH_INFO'] = (string) $controller->getUrlBasePath() . 'testing_css/grid.css';
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/grid.css');
        $this->assertEquals($expected, $actual);
        unset($_SERVER['PATH_INFO']);
    }

}

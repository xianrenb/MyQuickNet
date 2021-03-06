<?php

/**
 * MQNStaticFileControllerTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\static_file;

use com\googlecode\myquicknet\testing\TestingStaticFileController;

/**
 * Test class for MQNStaticFileController.
 */
class MQNStaticFileControllerTest extends \PHPUnit_Framework_TestCase
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
        $controller = new MQNStaticFileController();
        $this->assertTrue($controller instanceof MQNStaticFileController);
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test2()
    {
        $controller = new TestingStaticFileController();
        $this->assertTrue($controller instanceof MQNStaticFileController);
        $_SERVER['PATH_INFO'] = (string) $controller->getUrlBasePath() . 'testing_static_file/html/default.html';
        ob_start();
        $controller->run();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
        unset($_SERVER['PATH_INFO']);
    }

}

<?php

/**
 * MQNStaticFileViewTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\static_file;

/**
 * Test class for MQNStaticFileView.
 */
class MQNStaticFileViewTest extends \PHPUnit_Framework_TestCase
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
        $view = new MQNStaticFileView();
        $this->assertTrue($view instanceof MQNStaticFileView);
        ob_start();
        $this->assertFalse($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
    }

    public function test2()
    {
        $view = new MQNStaticFileView();
        $this->assertTrue($view instanceof MQNStaticFileView);
        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test3()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\static_file\\MQNStaticFileView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNStaticFileView);

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array()));

        $view->expects($this->exactly(7))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test4()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\static_file\\MQNStaticFileView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNStaticFileView);
        $fileName = (string) (MQN_BASE_PATH . 'html/default.html');
        $eTag = '"' . md5_file($fileName) . '"';

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-none-match' => (string) $eTag
                        )));

        $view->expects($this->once())
                ->method('_header')
                ->with($this->equalTo('Status: 304 Not Modified'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = '';
        $this->assertEquals($expected, $actual);
    }

    public function test5()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\static_file\\MQNStaticFileView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNStaticFileView);
        $fileName = (string) (MQN_BASE_PATH . 'html/default.html');
        $eTag = '"' . md5('') . '"';

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-none-match' => (string) $eTag
                        )));

        $view->expects($this->exactly(7))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

    public function test6()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\static_file\\MQNStaticFileView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNStaticFileView);
        $fileName = (string) (MQN_BASE_PATH . 'html/default.html');
        $modifiedTime = (int) filemtime($fileName);
        $lastModified = (string) date(DATE_RFC1123, $modifiedTime);

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-modified-since' => (string) $lastModified
                        )));

        $view->expects($this->once())
                ->method('_header')
                ->with($this->equalTo('Status: 304 Not Modified'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = '';
        $this->assertEquals($expected, $actual);
    }

    public function test7()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\static_file\\MQNStaticFileView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNStaticFileView);
        $fileName = (string) (MQN_BASE_PATH . 'html/default.html');
        $modifiedTime = (int) filemtime($fileName) - 1;
        $lastModified = (string) date(DATE_RFC1123, $modifiedTime);

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-modified-since' => (string) $lastModified
                        )));

        $view->expects($this->exactly(7))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        $view->setStaticFilePath(MQN_BASE_PATH);
        $view->setStaticFileName('html/default.html');
        ob_start();
        $view->output();
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(MQN_BASE_PATH . 'html/default.html');
        $this->assertEquals($expected, $actual);
    }

}

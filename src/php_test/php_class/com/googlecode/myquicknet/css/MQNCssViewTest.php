<?php

/**
 * MQNCssViewTest
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\css;

/**
 * Test class for MQNCssView.
 */
class MQNCssViewTest extends \PHPUnit_Framework_TestCase
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

    public function test01()
    {
        $view = new MQNCssView();
        $this->assertTrue($view instanceof MQNCssView);
        ob_start();
        $this->assertTrue($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test02()
    {
        $view = new MQNCssView();
        $this->assertTrue($view instanceof MQNCssView);
        ob_start();
        $this->assertTrue($view->outputReset());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test03()
    {
        $view = new MQNCssView();
        $this->assertTrue($view instanceof MQNCssView);
        ob_start();
        $this->assertTrue($view->outputGrid());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/grid.css');
        $this->assertEquals($expected, $actual);
    }

    public function test04()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array()));

        $view->expects($this->exactly(5))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        ob_start();
        $this->assertTrue($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test05()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array()));

        $view->expects($this->exactly(5))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        ob_start();
        $this->assertTrue($view->outputReset());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test06()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array()));

        $view->expects($this->exactly(5))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        ob_start();
        $this->assertTrue($view->outputGrid());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/grid.css');
        $this->assertEquals($expected, $actual);
    }

    public function test07()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);
        $eTag = '"' . md5_file(__DIR__ . '/reset.css') . '"';

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

        ob_start();
        $this->assertTrue($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = '';
        $this->assertEquals($expected, $actual);
    }

    public function test08()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);
        $eTag = '"' . md5_file(__DIR__ . '/reset.css') . '"';

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

        ob_start();
        $this->assertTrue($view->outputReset());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = '';
        $this->assertEquals($expected, $actual);
    }

    public function test09()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);
        $eTag = '"' . md5_file(__DIR__ . '/grid.css') . '"';

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

        ob_start();
        $this->assertTrue($view->outputGrid());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = '';
        $this->assertEquals($expected, $actual);
    }

    public function test10()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);
        $eTag = '"' . md5('') . '"';

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-none-match' => (string) $eTag
                        )));

        $view->expects($this->exactly(5))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        ob_start();
        $this->assertTrue($view->output());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test11()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);
        $eTag = '"' . md5('') . '"';

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-none-match' => (string) $eTag
                        )));

        $view->expects($this->exactly(5))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        ob_start();
        $this->assertTrue($view->outputReset());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/reset.css');
        $this->assertEquals($expected, $actual);
    }

    public function test12()
    {
        $view = $this->getMockBuilder('\\com\\googlecode\\myquicknet\\css\\MQNCssView')
                ->setMethods(array(
                    '_getAllHeaders',
                    '_header',
                    '_headersSent'
                ))
                ->getMock();

        $this->assertTrue($view instanceof MQNCssView);
        $eTag = '"' . md5('') . '"';

        $view->expects($this->once())
                ->method('_getAllHeaders')
                ->will($this->returnValue(array(
                            'if-none-match' => (string) $eTag
                        )));

        $view->expects($this->exactly(5))
                ->method('_header')
                ->with($this->isType('string'));

        $view->expects($this->once())
                ->method('_headersSent')
                ->will($this->returnValue(false));

        ob_start();
        $this->assertTrue($view->outputGrid());
        $actual = (string) ob_get_contents();
        ob_end_clean();
        $expected = (string) file_get_contents(__DIR__ . '/grid.css');
        $this->assertEquals($expected, $actual);
    }

}

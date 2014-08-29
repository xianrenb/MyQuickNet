<?php

/**
 * MQNDomToolsTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\dom;

/**
 * Test class for MQNDomTools.
 */
class MQNDomToolsTest extends \PHPUnit_Framework_TestCase
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
        $domTools = new MQNDomTools();
        $this->assertTrue($domTools instanceof MQNDomTools);
        $html = 'abc abc&quot;abc&nbsp;abc&yuml;abc&badnamedentity;abc';
        $actual = (string) $domTools->convertNamedEntityToNumericEntity($html);
        $expected = 'abc abc&#34;abc&#160;abc&#255;abc&#160;abc';
        $this->assertEquals($expected, $actual);
        $domTools->setNumericEntityArray('&customnamedentity;', '&#8888;');
        $html = 'abc abc&quot;abc&nbsp;abc&yuml;abc&customnamedentity;abc';
        $actual = (string) $domTools->convertNamedEntityToNumericEntity($html);
        $expected = 'abc abc&#34;abc&#160;abc&#255;abc&#8888;abc';
        $this->assertEquals($expected, $actual);
        $domTools->resetNumericEntityArray();
        $actual = (string) $domTools->convertNamedEntityToNumericEntity($html);
        $expected = 'abc abc&#34;abc&#160;abc&#255;abc&#160;abc';
        $this->assertEquals($expected, $actual);
    }

}

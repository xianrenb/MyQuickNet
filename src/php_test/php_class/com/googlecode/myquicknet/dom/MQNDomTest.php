<?php

/**
 * MQNDomTest
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\dom;

/**
 * Test class for MQNDom.
 */
class MQNDomTest extends \PHPUnit_Framework_TestCase {

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
        $dom = new MQNDom();
        $doc = $dom->getDoc();
        $xPath = $dom->getXPath();
        $this->assertTrue($doc instanceof \DOMDocument);
        $this->assertTrue($xPath === null);
        $dom->load(__DIR__ . '/input.xml');
        $dom->save(__DIR__ . '/output.xml');
        $doc = $dom->getDoc();
        $xPath = $dom->getXPath();
        $this->assertTrue($doc instanceof \DOMDocument);
        $this->assertTrue($xPath instanceof \DOMXPath);
        $input = (string) file_get_contents(__DIR__ . '/input.xml');
        $output = (string) file_get_contents(__DIR__ . '/output.xml');
        $this->assertEquals($input, $output);
    }

    public function test2() {
        $dom = new MQNDom();
        $dom->loadHTMLFile(__DIR__ . '/input.html');
        $dom->saveHTMLFile(__DIR__ . '/output.html');
        $input = (string) file_get_contents(__DIR__ . '/input.html');
        $output = (string) file_get_contents(__DIR__ . '/output.html');
        $this->assertEquals($input, $output);
    }

    public function test3() {
        $dom = new MQNDom();
        $input = (string) file_get_contents(__DIR__ . '/input.xml');
        $dom->loadXML($input);
        $output = $dom->saveXML();
        $this->assertEquals($input, $output);
    }

    public function test4() {
        $dom = new MQNDom();
        $input = (string) file_get_contents(__DIR__ . '/input.html');
        $dom->loadHTML($input);
        $output = $dom->saveHTML();
        $this->assertEquals($input, $output);
    }

    public function test5() {
        $dom = new MQNDom();
        $dom->load(__DIR__ . '/input_template.xml');
        $attrValue = $dom->queryAttr('//attr/data', 'attr');
        $this->assertEquals('attr', $attrValue);
        $attrValue = $dom->queryAttr('//attr/badData', 'attr');
        $this->assertEquals(null, $attrValue);

        $text = $dom->queryDo('//do/data', function (\DOMNodeList $nodes, MQNDom $dom) {
                    $node = $nodes->item(0);

                    if ($node && $node->firstChild && ($node->firstChild instanceof \DOMText)) {
                        $text = (string) $node->firstChild->wholeText;
                        return $text;
                    } else {
                        return null;
                    }
                });

        $this->assertEquals('do', $text);

        $dom->queryDo('//do/tagA', function (\DOMNodeList $nodes, MQNDom $dom) {
                    foreach ($nodes as $node) {
                        $node->appendChild($dom->getDoc()->createTextNode('text'));
                    }
                });

        $text = $dom->queryText('//text/data');
        $this->assertEquals('text', $text);
        $text = $dom->queryText('//text/badData');
        $this->assertEquals(null, $text);
        $value = $dom->queryVal('//val/data');
        $this->assertEquals('value', $value);
        $value = $dom->queryVal('//val/badData');
        $this->assertEquals(null, $value);
        $xml = $dom->queryXml('//xml/data');
        $this->assertEquals('<a/><b/>', $xml);
        $xml = $dom->queryXml('//xml/badData');
        $this->assertEquals(null, $xml);
        $dom->queryAttr('//attr/tagA', 'attr', 'attr');
        $dom->queryAttr('//attr/tagB', 'attr', 'attr');
        $dom->queryAttr('//attr/tagC', 'attr', 'attr');
        $dom->queryText('//text/tagA', 'text');
        $dom->queryText('//text/tagB', 'text');
        $dom->queryText('//text/tagC', 'text');
        $dom->queryVal('//val/tagA', 'value');
        $dom->queryVal('//val/tagB', 'value');
        $dom->queryVal('//val/tagC', 'value');
        $dom->queryXml('//xml/tagA', '<xml></xml>');
        $dom->queryXml('//xml/tagB', '<xml></xml>');
        $dom->queryXml('//xml/tagC', '<xml></xml>');
        $actual = (string) $dom->saveXML();
        $dom = new MQNDom();
        $dom->load(__DIR__ . '/output_template.xml');
        $expected = (string) $dom->saveXML();
        $this->assertEquals($expected, $actual);
    }

}

?>

<?php

/**
 * MQNAutoRecordQueryResourceTest
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQueryResource.
 */
class MQNAutoRecordQueryResourceTest extends \PHPUnit_Framework_TestCase
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
        $resource = new MQNAutoRecordQueryResource();
        $this->assertTrue($resource instanceof MQNAutoRecordQueryResource);
    }

    public function test2()
    {
        $resource = new MQNAutoRecordQueryResource(1, 'name');
        $this->assertTrue($resource instanceof MQNAutoRecordQueryResource);
        $this->assertTrue($resource->getId() === 1);
        $this->assertTrue($resource->getName() === 'name');
    }

}

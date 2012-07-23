<?php

/**
 * MQNAutoRecordQueryOrderTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 * Test class for MQNAutoRecordQueryOrder.
 */
class MQNAutoRecordQueryOrderTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var string
     */
    private $testingAutoRecordClass;

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
        $order = new MQNAutoRecordQueryOrder();
        $this->assertTrue($order instanceof MQNAutoRecordQueryOrder);
    }

    public function test2() {
        $order = new MQNAutoRecordQueryOrder(1, 'name');
        $this->assertTrue($order instanceof MQNAutoRecordQueryOrder);
        $this->assertTrue($order->getId() == 1);
        $this->assertTrue($order->getName() == 'name');
    }

    public function test3() {
        $order = new MQNAutoRecordQueryOrder(1, 'order');
        $this->assertTrue($order instanceof MQNAutoRecordQueryOrder);
        $field = new MQNAutoRecordQueryField(2, 'field');
        $this->assertEquals(true, $order->isAscending());
        $order->setAscending(false);
        $order->setField($field);
        $this->assertEquals(false, $order->isAscending());
        $this->assertEquals($field, $order->getField());
    }

}

?>
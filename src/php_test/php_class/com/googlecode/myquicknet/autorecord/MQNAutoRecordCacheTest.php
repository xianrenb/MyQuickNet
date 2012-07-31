<?php

/**
 * MQNAutoRecordCacheTest
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 * Test class for MQNAutoRecordCache.
 */
class MQNAutoRecordCacheTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var string
     */
    private $testingAutoRecordCacheClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->testingAutoRecordCacheClass = 'TestingAutoRecordCache';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $record1 = new $this->testingAutoRecordCacheClass();
        $this->assertTrue($record1 instanceof MQNAutoRecordCache);
        $this->assertTrue($record1->methodA() == 'TestingAutoRecordCache');
        $record1->create();
        $this->assertTrue($record1->getId() == 1);
        $this->assertTrue($record1->isValid());
        $record2 = new $this->testingAutoRecordCacheClass();
        $record2->create();
        $this->assertTrue($record2->getId() == 2);
        $this->assertTrue($record2->isValid());
        $record2->setMyA(false);
        $record2->setMyB(1.1);
        $record2->setMyC(2);
        $record2->setMyD('abc');
        $record2->setMyE($record1);
        $id = (int) $record2->getId();
        $record2 = null;
        $record2 = new $this->testingAutoRecordCacheClass();
        $record2->read($id);
        $this->assertTrue($record2->getMyA() == false);
        $this->assertTrue($record2->getMyB() == 1.1);
        $this->assertTrue($record2->getMyC() == 2);
        $this->assertTrue($record2->getMyD() == 'abc');
        $this->assertTrue($record2->getMyE() == $record1->getId());
        $record2->delete();
        $this->assertTrue($record2->getId() == 0);
        $this->assertFalse($record2->isValid());
        $record1->delete();
        $record1 = null;
        $record2 = null;
    }

    public function test2() {
        $record1 = new $this->testingAutoRecordCacheClass();
        $record1->create();
        $id = (int) $record1->getId();
        $record2 = new $this->testingAutoRecordCacheClass();
        $record2->read($id);
        $record3 = new $this->testingAutoRecordCacheClass();
        $record3->create();
        $record4 = new $this->testingAutoRecordCacheClass();
        $record4->read($id);
        $record1->setMyA(false);
        $record1->setMyB(1.1);
        $record1->setMyC(2);
        $record1->setMyD('abc');
        $record1->setMyE($record3);
        $this->assertTrue($record2->getMyA() == false);
        $this->assertTrue($record2->getMyB() == 1.1);
        $this->assertTrue($record2->getMyC() == 2);
        $this->assertTrue($record2->getMyD() == 'abc');
        $this->assertTrue($record2->getMyE() == $record3->getId());
        $this->assertTrue($record4->getMyA() == false);
        $this->assertTrue($record4->getMyB() == 1.1);
        $this->assertTrue($record4->getMyC() == 2);
        $this->assertTrue($record4->getMyD() == 'abc');
        $this->assertTrue($record4->getMyE() == $record3->getId());
        $record4->setMyA(true);
        $record4->setMyB(2.2);
        $record4->setMyC(3);
        $record4->setMyD('def');
        $record4->setMyE($record1);
        $record4 = null;
        $this->assertTrue($record1->getMyA() == true);
        $this->assertTrue($record1->getMyB() == 2.2);
        $this->assertTrue($record1->getMyC() == 3);
        $this->assertTrue($record1->getMyD() == 'def');
        $this->assertTrue($record1->getMyE() == $record1->getId());
        $this->assertTrue($record2->getMyA() == true);
        $this->assertTrue($record2->getMyB() == 2.2);
        $this->assertTrue($record2->getMyC() == 3);
        $this->assertTrue($record2->getMyD() == 'def');
        $this->assertTrue($record2->getMyE() == $record1->getId());
        $record1->delete();
        $this->assertFalse($record2->isValid());
        $this->assertTrue($record3->isValid());
        $record1 = null;
        $record2 = null;
        $record3->delete();
        $record3 = null;
    }

}

?>

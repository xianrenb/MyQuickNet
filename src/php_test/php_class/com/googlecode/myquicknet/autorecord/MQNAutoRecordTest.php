<?php

/**
 * MQNAutoRecordTest
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 * Test class for MQNAutoRecord.
 */
class MQNAutoRecordTest extends PHPUnit_Framework_TestCase {

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
        $this->testingAutoRecordClass = 'TestingAutoRecord';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function test1() {
        $record1 = new $this->testingAutoRecordClass();
        $this->assertTrue($record1 instanceof MQNAutoRecord);
        $this->assertTrue($record1->methodA() == 'TestingAutoRecord');
        $record1->create();
        $this->assertTrue($record1->getId() == 1);
        $this->assertTrue($record1->isValid());
        $record2 = new $this->testingAutoRecordClass();
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
        $record2 = new $this->testingAutoRecordClass();
        $record2->read($id);
        $this->assertTrue($record2->getMyA() == false);
        $this->assertTrue($record2->getMyB() == 1.1);
        $this->assertTrue($record2->getMyC() == 2);
        $this->assertTrue($record2->getMyD() == 'abc');
        $this->assertTrue($record2->getMyE() == $record1->getId());
        $record2->delete();
        $this->assertTrue($record2->getId() == 0);
        $this->assertFalse($record2->isValid());

        try {
            $record1->badMethod();
            $exception = false;
        } catch (BadMethodCallException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            $record1->setBadDataMember(1);
            $exception = false;
        } catch (BadMethodCallException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);

        try {
            $record1->getBadDataMember();
            $exception = false;
        } catch (BadMethodCallException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
        $record1->delete();
        $record1 = null;
        $record2 = null;
    }

}

?>

<?php

/**
 * MQNAutoRecordQueryResultArrayTest
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQueryResultArray.
 */
class MQNAutoRecordQueryResultArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var string
     */
    private $testingAutoRecordClass;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->testingAutoRecordClass = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecord';
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
        $resultArray = new MQNAutoRecordQueryResultArray();
        $this->assertTrue($resultArray instanceof MQNAutoRecordQueryResultArray);
    }

    public function test2()
    {
        $resultArray = new MQNAutoRecordQueryResultArray(1, 'name');
        $this->assertTrue($resultArray instanceof MQNAutoRecordQueryResultArray);
        $this->assertTrue($resultArray->getId() === 1);
        $this->assertTrue($resultArray->getName() === 'name');
    }

    public function test3()
    {
        $resultArray = new MQNAutoRecordQueryResultArray(1, 'result');
        $this->assertTrue($resultArray instanceof MQNAutoRecordQueryResultArray);
        $a = array();
        $table1 = new MQNAutoRecordQueryTable(2, 'table1');
        $table2 = new MQNAutoRecordQueryTable(3, 'table2');
        $autoRecordClassName = (string) $this->testingAutoRecordClass;
        $autoRecord1 = new $autoRecordClassName();
        $autoRecord2 = new $autoRecordClassName();
        $table1->setAutoRecord($autoRecord1);
        $table1->setAutoRecordClassName($autoRecordClassName);
        $table2->setAutoRecord($autoRecord2);
        $table2->setAutoRecordClassName($autoRecordClassName);
        $expectedAutoRecord1 = new $autoRecordClassName();
        $expectedAutoRecord1->create();
        $expectedAutoRecord1->update();
        $expectedAutoRecord2 = new $autoRecordClassName();
        $expectedAutoRecord2->create();
        $expectedAutoRecord2->update();

        for ($i = 0; $i < 10; ++$i) {
            $a[$i] = array(
                'id' . $table1->getId() => $expectedAutoRecord1->getId(),
                'id' . $table2->getId() => $expectedAutoRecord2->getId()
            );
        }

        $resultArray->setResultArray($a);
        $this->assertEquals(10, $resultArray->count());

        for ($i = 0; $i < 10; ++$i) {
            $result = $resultArray->nextResult();
            $this->assertTrue($result instanceof MQNAutoRecordQueryResult);
            $this->assertEquals($expectedAutoRecord1->getId(), $result->getAutoRecordId($table1));
            $this->assertEquals($expectedAutoRecord2->getId(), $result->getAutoRecordId($table2));
        }

        $this->assertNull($resultArray->nextResult());
        $expectedAutoRecord1->delete();
        $expectedAutoRecord2->delete();
        $autoRecord1 = null;
        $autoRecord2 = null;
        $expectedAutoRecord1 = null;
        $expectedAutoRecord2 = null;
    }

    public function test4()
    {
        $resultArray = new MQNAutoRecordQueryResultArray(1, 'result');
        $this->assertTrue($resultArray instanceof MQNAutoRecordQueryResultArray);
        $a = array();
        $table1 = new MQNAutoRecordQueryTable(2, 'table1');
        $table2 = new MQNAutoRecordQueryTable(3, 'table2');
        $autoRecordClassName = (string) $this->testingAutoRecordClass;
        $autoRecord1 = new $autoRecordClassName();
        $autoRecord2 = new $autoRecordClassName();
        $table1->setAutoRecord($autoRecord1);
        $table1->setAutoRecordClassName($autoRecordClassName);
        $table2->setAutoRecord($autoRecord2);
        $table2->setAutoRecordClassName($autoRecordClassName);
        $expectedAutoRecord1 = new $autoRecordClassName();
        $expectedAutoRecord1->create();
        $expectedAutoRecord1->update();
        $expectedAutoRecord2 = new $autoRecordClassName();
        $expectedAutoRecord2->create();
        $expectedAutoRecord2->update();

        for ($i = 0; $i < 10; ++$i) {
            $a[$i] = array(
                'id' . $table1->getId() => $expectedAutoRecord1->getId(),
                'id' . $table2->getId() => $expectedAutoRecord2->getId()
            );
        }

        $resultArray->setResultArray($a);
        $this->assertEquals(10, $resultArray->count());

        foreach ($resultArray as $result) {
            $this->assertTrue($result instanceof MQNAutoRecordQueryResult);
            $this->assertEquals($expectedAutoRecord1->getId(), $result->getAutoRecordId($table1));
            $this->assertEquals($expectedAutoRecord2->getId(), $result->getAutoRecordId($table2));
        }

        try {
            $noException = true;
            $exceptionMessage = '';

            foreach ($resultArray as $result) {

            }
        } catch (\Exception $e) {
            $noException = false;
            $exceptionMessage = (string) $e->getMessage();
        }

        $this->assertFalse($noException);
        $this->assertEquals('Could not rewind.', $exceptionMessage);
        $expectedAutoRecord1->delete();
        $expectedAutoRecord2->delete();
        $autoRecord1 = null;
        $autoRecord2 = null;
        $expectedAutoRecord1 = null;
        $expectedAutoRecord2 = null;
    }

}

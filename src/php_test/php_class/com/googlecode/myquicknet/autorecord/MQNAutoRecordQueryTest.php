<?php

/**
 * MQNAutoRecordQueryTest
 * @package MyQuickNet
 * @version 4.7
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 * Test class for MQNAutoRecordQuery.
 */
class MQNAutoRecordQueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var array
     */
    private $autoRecordAArray;

    /**
     *
     * @var array
     */
    private $autoRecordBArray;

    /**
     *
     * @var array
     */
    private $autoRecordCArray;

    /**
     *
     * @var string
     */
    private $testingAutoRecordAClassName;

    /**
     *
     * @var string
     */
    private $testingAutoRecordBClassName;

    /**
     *
     * @var string
     */
    private $testingAutoRecordCClassName;

    /**
     *
     * @var string
     */
    private $testingAutoRecordClassName;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->testingAutoRecordAClassName = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordA';
        $this->testingAutoRecordBClassName = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordB';
        $this->testingAutoRecordCClassName = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordC';
        $this->testingAutoRecordClassName = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecord';

        for ($i = 0; $i < 10; ++$i) {
            $this->autoRecordAArray[$i] = new $this->testingAutoRecordAClassName();
            $this->autoRecordAArray[$i]->create();
            $this->autoRecordAArray[$i]->setMyA($i);
            $this->autoRecordAArray[$i]->setMyX($i);
            $this->autoRecordAArray[$i]->update();
            $this->autoRecordBArray[$i] = new $this->testingAutoRecordBClassName();
            $this->autoRecordBArray[$i]->create();
            $this->autoRecordBArray[$i]->setMyB($i + 1);
            $this->autoRecordBArray[$i]->setMyX($i + 2);
            $this->autoRecordBArray[$i]->setMyY($i + 3);
            $this->autoRecordBArray[$i]->update();
            $this->autoRecordCArray[$i] = new $this->testingAutoRecordCClassName();
            $this->autoRecordCArray[$i]->create();
            $this->autoRecordCArray[$i]->setMyC($i + 2);
            $this->autoRecordCArray[$i]->setMyY($i + 4);
            $this->autoRecordCArray[$i]->update();
        }
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        for ($i = 0; $i < 10; ++$i) {
            $this->autoRecordAArray[$i]->delete();
            $this->autoRecordBArray[$i]->delete();
            $this->autoRecordCArray[$i]->delete();
            $this->autoRecordAArray[$i] = null;
            $this->autoRecordBArray[$i] = null;
            $this->autoRecordCArray[$i] = null;
        }
    }

    public function test1()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $query = null;
    }

    public function test2()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $table = $query->table($this->testingAutoRecordClassName);
        $resultArray = $query->execute();
        $resultArrayCount = $resultArray->count();
        $this->assertEquals(0, $resultArrayCount);
        $query = null;
        $table = null;
    }

    public function test3()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $resultArray = $query->execute();
        $resultArrayCount = $resultArray->count();
        $this->assertEquals(10, $resultArrayCount);
        $i = 0;

        foreach ($resultArray as $key => $value) {
            $autoRecordA = $value->getAutoRecord($tableA);
            $this->assertEquals($i, $key);
            $this->assertEquals($i, $autoRecordA->getMyA());
            $this->assertEquals($i, $autoRecordA->getMyX());
            $i += 1;
        }

        $this->assertEquals(10, $i);
        $query = null;
        $tableA = null;
        $autoRecordA = null;
    }

    public function test4()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $resultArray = $query->execute();
        $resultArrayCount = $resultArray->count();
        $this->assertEquals(100, $resultArrayCount);
        $query = null;
        $tableA = null;
        $tableB = null;
    }

    public function test5()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $tableC = $query->table($this->testingAutoRecordCClassName);
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');
        $fieldCY = $query->field($tableC, 'my_y');
        $query->condition($fieldAX, '=', $fieldBX);
        $query->condition($fieldBY, '=', $fieldCY);
        $resultArray = $query->execute();
        $result = $resultArray->nextResult();
        $n = 0;

        while ($result) {
            ++$n;
            $autoRecordA = $result->getAutoRecord($tableA);
            $this->assertEquals($autoRecordA->getMyA(), $autoRecordA->getMyX());
            $autoRecordB = $result->getAutoRecord($tableB);
            $this->assertEquals($autoRecordB->getMyB() + 1, $autoRecordB->getMyX());
            $this->assertEquals($autoRecordB->getMyX() + 1, $autoRecordB->getMyY());
            $autoRecordC = $result->getAutoRecord($tableC);
            $this->assertEquals($autoRecordC->getMyC() + 2, $autoRecordC->getMyY());
            $result = $resultArray->nextResult();
        }

        $this->assertEquals(7, $n);
        $query = null;
        $tableA = null;
        $tableB = null;
        $tableC = null;
        $autoRecordA = null;
        $autoRecordB = null;
        $autoRecordC = null;
    }

    public function test6()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $tableC = $query->table($this->testingAutoRecordCClassName);
        $fieldAA = $query->field($tableA, 'my_a');
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');
        $fieldCY = $query->field($tableC, 'my_y');
        $query->condition($fieldAA, '>=', 7);
        $query->condition($fieldAX, '=', $fieldBX);
        $query->condition($fieldBY, '=', $fieldCY);
        $query->order($fieldAA, false);
        $query->order($fieldAX);
        $resultArray = $query->execute();
        $result = $resultArray->nextResult();
        $n = 0;

        while ($result) {
            ++$n;
            $autoRecordA = $result->getAutoRecord($tableA);
            $this->assertEquals($autoRecordA->getMyA(), $autoRecordA->getMyX());
            $autoRecordB = $result->getAutoRecord($tableB);
            $this->assertEquals($autoRecordB->getMyB() + 1, $autoRecordB->getMyX());
            $this->assertEquals($autoRecordB->getMyX() + 1, $autoRecordB->getMyY());
            $autoRecordC = $result->getAutoRecord($tableC);
            $this->assertEquals($autoRecordC->getMyC() + 2, $autoRecordC->getMyY());
            $result = $resultArray->nextResult();
        }

        $this->assertEquals(3, $n);
        $this->assertEquals(7, $autoRecordA->getMyA());
        $query = null;
        $tableA = null;
        $tableB = null;
        $tableC = null;
        $autoRecordA = null;
        $autoRecordB = null;
        $autoRecordC = null;
    }

    public function test7()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $tableC = $query->table($this->testingAutoRecordCClassName);
        $fieldAA = $query->field($tableA, 'my_a');
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');
        $fieldCY = $query->field($tableC, 'my_y');
        $query->condition($fieldAA, '>=', 7);
        $query->condition($fieldAX, '=', $fieldBX);
        $query->condition($fieldBY, '=', $fieldCY);
        $query->order($fieldAA, false);
        $query->order($fieldAX);
        $query->limit(2, 1);
        $resultArray = $query->execute();
        $result = $resultArray->nextResult();
        $n = 0;

        while ($result) {
            ++$n;
            $autoRecordA = $result->getAutoRecord($tableA);
            $this->assertEquals($autoRecordA->getMyA(), $autoRecordA->getMyX());
            $autoRecordB = $result->getAutoRecord($tableB);
            $this->assertEquals($autoRecordB->getMyB() + 1, $autoRecordB->getMyX());
            $this->assertEquals($autoRecordB->getMyX() + 1, $autoRecordB->getMyY());
            $autoRecordC = $result->getAutoRecord($tableC);
            $this->assertEquals($autoRecordC->getMyC() + 2, $autoRecordC->getMyY());
            $result = $resultArray->nextResult();
        }

        $this->assertEquals(2, $n);
        $this->assertEquals(7, $autoRecordA->getMyA());
        $query = null;
        $tableA = null;
        $tableB = null;
        $tableC = null;
        $autoRecordA = null;
        $autoRecordB = null;
        $autoRecordC = null;
    }

    public function test8()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $fieldAX = $query->field($tableA, 'my_x');
        $query->condition($fieldAX, '=', 9, true);

        try {
            $query->execute();
            $exception = false;
        } catch (\Exception $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
        $query = null;
        $tableA = null;
    }

    public function test9()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $fieldAX = $query->field($tableA, 'my_x');
        $query->condition($fieldAX, '=', 9, true);
        $query->condition($fieldAX, '=', 8);
        $resultArray = $query->execute();
        $this->assertEquals(2, $resultArray->count());
        $query = null;
        $tableA = null;
    }

    public function test10()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $fieldAA = $query->field($tableA, 'my_a');
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');
        $query->condition($fieldAA, '>', 0);
        $query->condition($fieldAX, '=', $fieldBX);
        $query->condition($fieldAX, '=', 9, true);
        $query->condition($fieldAX, '=', 8, true);
        $query->condition($fieldAX, '=', 7);
        $query->condition($fieldBY, '>', 0);
        $resultArray = $query->execute();
        $this->assertEquals(3, $resultArray->count());
        $query = null;
        $tableA = null;
        $tableB = null;
    }

    public function test11()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $fieldAA = $query->field($tableA, 'my_a');
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');
        $query->condition($fieldAA, '>', 0);
        $query->condition($fieldAX, '=', $fieldBX);
        $query->condition($fieldAX, '=', 9, true);
        $query->condition($fieldAX, '=', 8, true);
        $query->condition($fieldAX, '=', 7);
        $query->condition($fieldBY, '<', 0);
        $resultArray = $query->execute();
        $this->assertEquals(0, $resultArray->count());
        $query = null;
        $tableA = null;
        $tableB = null;
    }

    public function test12()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $fieldAA = $query->field($tableA, 'my_a');
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');
        $query->condition($fieldAA, '>', 0, true);

        try {
            $query->condition($fieldAX, '=', $fieldBX);
            $exception = false;
        } catch (\InvalidArgumentException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
        $query = null;
        $tableA = null;
        $tableB = null;
    }

    public function test13()
    {
        $query = new MQNAutoRecordQuery();
        $this->assertTrue($query instanceof MQNAutoRecordQuery);
        $tableA = $query->table($this->testingAutoRecordAClassName);
        $tableB = $query->table($this->testingAutoRecordBClassName);
        $fieldAA = $query->field($tableA, 'my_a');
        $fieldAX = $query->field($tableA, 'my_x');
        $fieldBX = $query->field($tableB, 'my_x');
        $fieldBY = $query->field($tableB, 'my_y');

        try {
            $query->condition($fieldAX, '=', $fieldBX, true);
            $exception = false;
        } catch (\InvalidArgumentException $e) {
            $exception = true;
        }

        $this->assertTrue($exception);
        $query = null;
        $tableA = null;
        $tableB = null;
    }

}

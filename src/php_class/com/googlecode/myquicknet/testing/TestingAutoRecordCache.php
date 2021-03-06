<?php

/**
 * TestingAutoRecordCache
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing;

use com\googlecode\myquicknet\testing_config\TestingAutoRecordCacheConfig;

/**
 *
 */
class TestingAutoRecordCache extends TestingAutoRecordCacheConfig
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);
    }

    /**
     *
     * @return boolean
     */
    public function getMyA()
    {
        $myA = (bool) parent::getMyA();
        $this->methodB();

        return $myA;
    }

    /**
     *
     * @return string
     */
    public function methodA()
    {
        return 'TestingAutoRecordCache';
    }

    /**
     *
     */
    public function methodB()
    {
    }

    /**
     *
     * @return array
     */
    public function outputDefaultData()
    {
        $this->create();
        $dataArray = array();
        $dataArray['data_a'] = (bool) $this->getMyA();
        $dataArray['data_b'] = (float) $this->getMyB();
        $dataArray['data_c'] = (int) $this->getMyC();
        $dataArray['data_d'] = (string) $this->getMyD();
        $this->delete();

        return $dataArray;
    }

}

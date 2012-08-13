<?php

/**
 * TestingAutoRecordCache
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingAutoRecordCache extends TestingAutoRecordCacheConfig {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        parent::__construct();
    }

    /**
     *
     * @return boolean
     */
    public function getMyA() {
        $myA = (bool) parent::getMyA();
        $this->methodB();
        return $myA;
    }

    /**
     *
     * @return string
     */
    public function methodA() {
        return 'TestingAutoRecordCache';
    }

    /**
     * 
     */
    public function methodB() {
        
    }

    /**
     *
     * @return array
     */
    public function outputDefaultData() {
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

?>

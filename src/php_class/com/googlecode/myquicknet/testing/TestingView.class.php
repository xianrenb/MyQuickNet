<?php

/**
 * TestingView
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing;

use com\googlecode\myquicknet\autorecord\MQNAutoRecord;
use com\googlecode\myquicknet\dom\MQNDom;
use com\googlecode\myquicknet\testing_config\TestingViewConfig;

/**
 *
 */
class TestingView extends TestingViewConfig {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        parent::__construct($config);
    }

    /**
     *
     * @param MQNDom $dom
     * @param array $dataArray 
     */
    protected function _insertAdvanceExampleContent(MQNDom $dom, array $dataArray) {
        $query = '//span[@id=\'data_a\']';
        $text = (string) $dataArray['data_a'] ? 'true' : 'false';
        $dom->queryText($query, $text);
        $query = '//span[@id=\'data_b\']';
        $text = (string) $dataArray['data_b'];
        $dom->queryText($query, $text);
        $query = '//span[@id=\'data_c\']';
        $text = (string) $dataArray['data_c'];
        $dom->queryText($query, $text);
        $query = '//span[@id=\'data_d\']';
        $text = (string) $dataArray['data_d'];
        $dom->queryText($query, $text);
        $query = '//span[@id=\'s\']';
        $text = (string) $dataArray['s'];
        $dom->queryText($query, $text);
    }

    /**
     *
     * @param MQNAutoRecord $model
     * @param string $s
     * @return boolean 
     */
    public function advanceExample(MQNAutoRecord $model, $s) {
        new \String($s);
        $dataArray = $model->outputDefaultData();
        $dataArray['s'] = (string) $s;
        $dom = new MQNDom();
        $dom->load(MQN_BASE_PATH . 'html/testing.advance_example.html');
        $this->_insertAdvanceExampleContent($dom, $dataArray);
        $doc = $dom->getDoc();
        $xhtml = (string) $doc->saveXML($doc->doctype);
        $xhtml .= "\n";
        $xhtml .= (string) $doc->saveXML($doc->documentElement);
        echo($xhtml);
        return true;
    }

    /**
     *
     * @param MQNAutoRecord $model
     * @return boolean
     */
    public function getData(MQNAutoRecord $model) {
        $model->create();
        $dataArray = array();
        $dataArray['a'] = $model->getMyA();
        $dataArray['b'] = $model->getMyB();
        $dataArray['c'] = $model->getMyC();
        $dataArray['d'] = $model->getMyD();
        $this->setJSONString(json_encode($dataArray));
        $model->delete();
        return $this->outputJSON();
    }

    /**
     *
     * @return boolean
     */
    public function outputJSON() {
        if (!headers_sent()) {
            header('Content-Type: application/json');
        }

        return $this->_outputJSON();
    }

    /**
     *
     * @return boolean
     */
    public function outputHTML() {
        return $this->_outputHTML();
    }

}

?>

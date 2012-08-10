<?php

/**
 * TestingView
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

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
     * @param DOMDocument $doc
     * @param DOMXPath $xpath
     * @param array $dataArray 
     */
    protected function _insertAdvanceExampleContent($doc, $xpath, $dataArray) {
        $query = '//span[@id=\'data_a\']';

        foreach ($xpath->query($query, $doc) as $span) {
            $span->appendChild($doc->createTextNode($dataArray['data_a'] ? 'true' : 'false'));
            $span->normalize();
        }

        $query = '//span[@id=\'data_b\']';

        foreach ($xpath->query($query, $doc) as $span) {
            $span->appendChild($doc->createTextNode($dataArray['data_b']));
            $span->normalize();
        }

        $query = '//span[@id=\'data_c\']';

        foreach ($xpath->query($query, $doc) as $span) {
            $span->appendChild($doc->createTextNode($dataArray['data_c']));
            $span->normalize();
        }

        $query = '//span[@id=\'data_d\']';

        foreach ($xpath->query($query, $doc) as $span) {
            $span->appendChild($doc->createTextNode($dataArray['data_d']));
            $span->normalize();
        }

        $query = '//span[@id=\'s\']';

        foreach ($xpath->query($query, $doc) as $span) {
            $span->appendChild($doc->createTextNode($dataArray['s']));
            $span->normalize();
        }
    }

    /**
     *
     * @param MQNAutoRecord $model
     * @param string $s
     * @return boolean 
     */
    public function advanceExample($model, $s) {
        new String($s);
        $dataArray = $model->outputDefaultData();
        $dataArray['s'] = $s;
        $html = (string) file_get_contents(MQN_BASE_PATH . 'html/testing.advance_example.html');
        $doc = new DOMDocument();
        $doc->formatOutput = true;
        $doc->loadXML($html);
        $xpath = new DOMXPath($doc);
        $this->_insertAdvanceExampleContent($doc, $xpath, $dataArray);
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
    public function getData($model) {
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

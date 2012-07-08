<?php

/**
 * MQNView
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 *
 */
class MQNView {

    /**
     *
     * @var string
     */
    private $jsonString;

    /**
     *
     * @var string
     */
    private $htmlFileName;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        if (key_exists('json_string', $config)) {
            $this->jsonString = (string) $config['json_string'];
        } else {
            $this->jsonString = '{}';
        }

        if (key_exists('html_file_name', $config)) {
            $this->htmlFileName = (string) $config['html_file_name'];
        } else {
            $this->htmlFileName = (string) (MQN_BASE_PATH . 'html/default.html');
        }
    }

    /**
     *
     * @return bool
     */
    protected function _outputJSON() {
        echo($this->jsonString);
        return true;
    }

    /**
     *
     * @return bool
     */
    protected function _outputHTML() {
        readfile($this->htmlFileName);
        return true;
    }

    /**
     *
     * @return bool
     */
    public function output() {
        return $this->_outputHTML();
    }

    /**
     *
     * @param string $jsonString
     */
    public function setJSONString($jsonString) {
        new String($jsonString);
        $this->jsonString = (string) $jsonString;
    }

    /**
     *
     * @param string $fileName
     */
    public function setHTMLFileName($fileName) {
        new String($fileName);
        $this->htmlFileName = (string) $fileName;
    }

}

?>

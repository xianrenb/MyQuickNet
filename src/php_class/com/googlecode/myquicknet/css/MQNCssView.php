<?php

/**
 * MQNCssView
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\css;

use com\googlecode\myquicknet\view\MQNView;

/**
 *
 */
class MQNCssView extends MQNView {

    /**
     *
     * @var int
     */
    private $cacheMaxAge;

    /**
     *
     * @var int
     */
    private $columnCount;

    /**
     *
     * @var int
     */
    private $columnWidth;

    /**
     *
     * @var int
     */
    private $gutterWidth;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        if (key_exists('cache_max_age', $config)) {
            $this->cacheMaxAge = (int) $config['cache_max_age'];
        } else {
            $this->cacheMaxAge = 20 * 60;
        }

        if (key_exists('column_count', $config)) {
            $this->columnCount = (int) $config['column_count'];
        } else {
            $this->columnCount = 12;
        }

        if (key_exists('column_width', $config)) {
            $this->columnWidth = (int) $config['column_width'];
        } else {
            $this->columnWidth = 60;
        }

        if (key_exists('gutter_width', $config)) {
            $this->gutterWidth = (int) $config['gutter_width'];
        } else {
            $this->gutterWidth = 20;
        }

        parent::__construct($config);
    }

    /**
     *
     * @return string
     */
    protected function _generateLeft() {
        $css = '';

        for ($column = 0; $column <= $this->columnCount; ++$column) {
            $css .= ".left_" . $column . " {\n";
            $css .= "left: " . ($column * ($this->columnWidth + $this->gutterWidth)) . "px;\n";
            $css .= "}\n";
        }

        return $css;
    }

    /**
     *
     * @return string
     */
    protected function _generateMLeft() {
        $css = '';

        for ($column = 0; $column <= $this->columnCount; ++$column) {
            $css .= ".mleft_" . $column . " {\n";
            $css .= "left: " . (-$column * ($this->columnWidth + $this->gutterWidth)) . "px;\n";
            $css .= "}\n";
        }

        return $css;
    }

    /**
     *
     * @return string
     */
    protected function _generatePLeft() {
        $css = '';

        for ($column = 0; $column <= $this->columnCount; ++$column) {
            $css .= ".pleft_" . $column . " {\n";
            $css .= "padding-left: " . ($column * ($this->columnWidth + $this->gutterWidth)) . "px;\n";
            $css .= "}\n";
        }

        return $css;
    }

    /**
     *
     * @return string
     */
    protected function _generatePRight() {
        $css = '';

        for ($column = 0; $column <= $this->columnCount; ++$column) {
            $css .= ".pright_" . $column . " {\n";
            $css .= "padding-right: " . ($column * ($this->columnWidth + $this->gutterWidth)) . "px;\n";
            $css .= "}\n";
        }

        return $css;
    }

    /**
     *
     * @return string
     */
    protected function _generateWidth() {
        $css = '';

        for ($column = 0; $column <= $this->columnCount; ++$column) {
            $css .= ".width_" . $column . " {\n";
            $css .= "width: " . ($column * $this->columnWidth + ($column ? (($column - 1) * $this->gutterWidth) : 0)) . "px;\n";
            $css .= "}\n";
        }

        return $css;
    }

    /**
     * 
     * @return array|boolean
     */
    protected function _getAllHeaders() {
        $headers = false;

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        }

        return $headers;
    }

    /**
     * 
     * @param string $header
     */
    protected function _header($header) {
        new \String($header);
        header($header);
    }

    /**
     * 
     * @return boolean
     */
    protected function _headersSent() {
        $headersSent = (bool) headers_sent();
        return $headersSent;
    }

    /**
     *
     * @param string $css
     * @return bool
     */
    protected function _outputCss($css) {
        new \String($css);

        if (!$this->_headersSent()) {
            $eTag = '"' . md5($css) . '"';
            $headers = $this->_getAllHeaders();

            if ($headers !== false) {
                $headers = array_change_key_case($headers, CASE_LOWER);
                $modified = true;

                if (key_exists('if-none-match', $headers) &&
                        (trim($headers['if-none-match']) === $eTag)
                ) {
                    $modified = false;
                }

                if (!$modified) {
                    if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
                        $this->_header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
                    }

                    $this->_header('Status: 304 Not Modified');
                    return true;
                }
            }

            $this->_header('ETag: ' . $eTag);
            $this->_header('Cache-Control: public, max-age=' . $this->cacheMaxAge);
            $this->_header('Vary: Accept-Encoding');
            $this->_header('Content-Length: ' . strlen($css));
            $this->_header('Content-Type: text/css');
        }

        echo($css);
        return true;
    }

    /**
     *
     * @return bool
     */
    public function output() {
        return $this->outputReset();
    }

    /**
     *
     * @return bool
     */
    public function outputGrid() {
        $css = ".clear {\n";
        $css .= "clear: both;\n";
        $css .= "display: block;\n";
        $css .= "height: 0;\n";
        $css .= "overflow: hidden;\n";
        $css .= "visibility: hidden;\n";
        $css .= "width: 0;\n";
        $css .= "}\n";
        $css .= ".grid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "margin-right: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "}\n";
        $css .= ".grid_container {\n";
        $css .= "margin-left: auto;\n";
        $css .= "margin-right: auto;\n";
        $css .= "position: relative;\n";
        $css .= "width: " . ($this->columnCount * ($this->columnWidth + $this->gutterWidth)) . "px;\n";
        $css .= "}\n";
        $css .= ".fgrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: 0px;\n";
        $css .= "margin-right: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "}\n";
        $css .= ".frgrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: 0px;\n";
        $css .= "margin-right: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "position: relative;\n";
        $css .= "}\n";
        $css .= ".igrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: 0px;\n";
        $css .= "margin-right: 0px;\n";
        $css .= "}\n";
        $css .= ".irgrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: 0px;\n";
        $css .= "margin-right: 0px;\n";
        $css .= "position: relative;\n";
        $css .= "}\n";
        $css .= ".lgrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "margin-right: 0px;\n";
        $css .= "}\n";
        $css .= ".lrgrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "margin-right: 0px;\n";
        $css .= "position: relative;\n";
        $css .= "}\n";
        $css .= ".rgrid {\n";
        $css .= "display: inline;\n";
        $css .= "float: left;\n";
        $css .= "margin-left: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "margin-right: " . ($this->gutterWidth / 2) . "px;\n";
        $css .= "position: relative;\n";
        $css .= "}\n";
        $css .= $this->_generateLeft();
        $css .= $this->_generateMLeft();
        $css .= $this->_generatePLeft();
        $css .= $this->_generatePRight();
        $css .= $this->_generateWidth();
        $this->_outputCss($css);
        return true;
    }

    /**
     *
     * @return bool
     */
    public function outputReset() {
        $css = "* {\n";
        $css .= "background: none repeat scroll 0 0 transparent;\n";
        $css .= "border: 0 none;\n";
        $css .= "font-size: 100%;\n";
        $css .= "margin: 0;\n";
        $css .= "outline: 0 none;\n";
        $css .= "padding: 0;\n";
        $css .= "vertical-align: baseline;\n";
        $css .= "}\n";
        $css .= "body {\n";
        $css .= "line-height: 1;\n";
        $css .= "min-width: " . ($this->columnCount * ($this->columnWidth + $this->gutterWidth)) . "px;\n";
        $css .= "}\n";
        $css .= "table {\n";
        $css .= "border-collapse: collapse;\n";
        $css .= "border-spacing: 0;\n";
        $css .= "}\n";
        $this->_outputCss($css);
        return true;
    }

}

?>

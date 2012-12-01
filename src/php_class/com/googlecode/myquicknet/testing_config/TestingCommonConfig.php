<?php

/**
 * TestingCommonConfig
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

/**
 *
 */
class TestingCommonConfig {

    /**
     *
     * @var string
     */
    private static $urlBasePath = '/MyQuickNet/';

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * 
     * @return string
     */
    public static function getUrlBasePath() {
        return self::$urlBasePath;
    }

}

?>

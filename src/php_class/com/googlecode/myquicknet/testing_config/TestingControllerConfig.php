<?php

/**
 * TestingControllerConfig
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\controller\MQNController;

/**
 *
 */
class TestingControllerConfig extends MQNController {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['model_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordCache';
        $config['url_base_path'] = (string) TestingCommonConfig::getUrlBasePath();
        $config['view_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingView';
        parent::__construct($config);
    }

}

?>

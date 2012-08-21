<?php

/**
 * TestingMainControllerConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\controller\MQNMainController;

/**
 *
 */
class TestingMainControllerConfig extends MQNMainController {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['controller_class_prefix'] = '\\com\\googlecode\\myquicknet\\testing\\';
        $config['main_controller_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingMainController';
        $config['url_base_path'] = '/MyQuickNet/';
        parent::__construct($config);
    }

}

?>

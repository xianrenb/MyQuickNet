<?php

/**
 * TestingMainControllerConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
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
        $config['main_controller_class'] = 'TestingMainController';
        $config['url_base_path'] = '/MyQuickNet/';
        parent::__construct($config);
    }

}

?>

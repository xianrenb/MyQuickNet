<?php

/**
 * TestingViewConfig
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\view\MQNView;

/**
 *
 */
class TestingViewConfig extends MQNView
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['json_string'] = '{}';
        $config['html_file_name'] = (string) (MQN_BASE_PATH . 'html/testing/default.html');
        parent::__construct($config);
    }

}

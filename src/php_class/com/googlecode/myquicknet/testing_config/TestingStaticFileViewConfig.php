<?php

/**
 * TestingStaticFileViewConfig
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\static_file\MQNStaticFileView;

/**
 *
 */
class TestingStaticFileViewConfig extends MQNStaticFileView
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['cache_max_age'] = 60 * 20;
        $config['static_file_path'] = (string) MQN_BASE_PATH;
        parent::__construct($config);
    }

}

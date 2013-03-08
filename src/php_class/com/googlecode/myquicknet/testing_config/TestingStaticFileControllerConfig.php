<?php

/**
 * TestingStaticFileControllerConfig
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\static_file\MQNStaticFileController;

/**
 *
 */
class TestingStaticFileControllerConfig extends MQNStaticFileController
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['url_base_path'] = (string) TestingCommonConfig::getUrlBasePath();
        $config['view_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingStaticFileView';
        parent::__construct($config);
    }

}

<?php

/**
 * TestingCssControllerConfig
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\css\MQNCssController;

/**
 *
 */
class TestingCssControllerConfig extends MQNCssController
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['url_base_path'] = (string) TestingCommonConfig::getUrlBasePath();
        $config['view_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingCssView';
        parent::__construct($config);
    }

}

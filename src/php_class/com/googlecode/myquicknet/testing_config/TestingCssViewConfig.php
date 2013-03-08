<?php

/**
 * TestingCssViewConfig
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\css\MQNCssView;

/**
 *
 */
class TestingCssViewConfig extends MQNCssView
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['cache_max_age'] = 20 * 60;
        $config['column_count'] = 12;
        $config['column_width'] = 60;
        $config['gutter_width'] = 20;
        parent::__construct($config);
    }

}

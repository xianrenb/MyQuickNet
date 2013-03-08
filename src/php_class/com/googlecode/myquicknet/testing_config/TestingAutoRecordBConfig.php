<?php

/**
 * TestingAutoRecordBConfig
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\autorecord\MQNAutoRecord;

/**
 *
 */
class TestingAutoRecordBConfig extends MQNAutoRecord
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['auto_record_manager_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordManager';

        $config['field_array'] = array(
            'my_b' => 0,
            'my_x' => 0,
            'my_y' => 0,
        );

        $config['table'] = 'table_b';
        parent::__construct($config);
    }

}

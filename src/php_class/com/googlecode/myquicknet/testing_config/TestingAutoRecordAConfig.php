<?php

/**
 * TestingAutoRecordAConfig
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\autorecord\MQNAutoRecord;

/**
 *
 */
class TestingAutoRecordAConfig extends MQNAutoRecord
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['auto_record_manager_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordManager';

        $config['field_array'] = array(
            'my_a' => 0,
            'my_x' => 0,
        );

        $config['table'] = 'table_a';
        parent::__construct($config);
    }

}

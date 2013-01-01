<?php

/**
 * TestingAutoRecordCacheConfig
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\autorecord\MQNAutoRecordCache;

/**
 *
 */
class TestingAutoRecordCacheConfig extends MQNAutoRecordCache
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $config['auto_record_manager_class'] = '\\com\\googlecode\\myquicknet\\testing\\TestingAutoRecordManager';

        $config['field_array'] = array(
            'my_a' => true,
            'my_b' => 2.2,
            'my_c' => 3,
            'my_d' => 'string',
            'my_e' => 0,
        );

        $config['table'] = 'testing_auto_record';
        parent::__construct($config);
    }

}

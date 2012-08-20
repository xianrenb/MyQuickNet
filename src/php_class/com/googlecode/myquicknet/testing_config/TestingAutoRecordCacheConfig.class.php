<?php

/**
 * TestingAutoRecordCacheConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
use com\googlecode\myquicknet\autorecord\MQNAutoRecordCache;

/**
 *
 */
class TestingAutoRecordCacheConfig extends MQNAutoRecordCache {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['auto_record_manager_class'] = 'TestingAutoRecordManager';

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

?>

<?php

/**
 * TestingAutoRecordAConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class TestingAutoRecordAConfig extends MQNAutoRecord {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['auto_record_manager_class'] = 'TestingAutoRecordManager';

        $config['field_array'] = array(
            'my_a' => 0,
            'my_x' => 0,
        );

        $config['table'] = 'table_a';
        parent::__construct($config);
    }

}

?>

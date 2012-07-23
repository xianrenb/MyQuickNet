<?php

/**
 * TestingAutoRecordCConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingAutoRecordCConfig extends MQNAutoRecord {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['auto_record_manager_class'] = 'TestingAutoRecordManager';

        $config['field_array'] = array(
            'my_c' => 0,
            'my_y' => 0,
        );

        $config['table'] = 'table_c';
        parent::__construct($config);
    }

}

?>
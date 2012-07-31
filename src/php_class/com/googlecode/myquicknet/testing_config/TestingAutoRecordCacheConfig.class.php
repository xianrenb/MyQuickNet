<?php

/**
 * TestingAutoRecordCacheConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

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

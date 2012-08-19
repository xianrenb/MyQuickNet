<?php

/**
 * TestingViewConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class TestingViewConfig extends MQNView {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['json_string'] = '{}';
        $config['html_file_name'] = (string) (MQN_BASE_PATH . 'html/testing.html');
        parent::__construct($config);
    }

}

?>

<?php

/**
 * TestingViewConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
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

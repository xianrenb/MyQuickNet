<?php

/**
 * TestingStaticFileViewConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class TestingStaticFileViewConfig extends MQNStaticFileView {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['cache_max_age'] = 60 * 20;
        $config['static_file_path'] = (string) MQN_BASE_PATH;
        parent::__construct($config);
    }

}

?>

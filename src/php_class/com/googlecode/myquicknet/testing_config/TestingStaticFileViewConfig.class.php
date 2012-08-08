<?php

/**
 * TestingStaticFileViewConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
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

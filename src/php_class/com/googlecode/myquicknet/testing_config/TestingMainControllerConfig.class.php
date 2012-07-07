<?php

/**
 * TestingMainControllerConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingMainControllerConfig extends MQNMainController {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['main_controller_class'] = 'TestingMainController';
        $config['url_base_path'] = '/MyQuickNet/';
        parent::__construct($config);
    }

}

?>

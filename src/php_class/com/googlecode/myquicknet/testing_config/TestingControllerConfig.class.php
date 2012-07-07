<?php

/**
 * TestingControllerConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingControllerConfig extends MQNController {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['model_class'] = 'TestingAutoRecord';
        $config['url_base_path'] = '/MyQuickNet/';
        $config['view_class'] = 'TestingView';
        parent::__construct($config);
    }

}

?>

<?php

/**
 * TestingControllerConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
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
        $config['model_class'] = 'TestingAutoRecordCache';
        $config['url_base_path'] = '/MyQuickNet/';
        $config['view_class'] = 'TestingView';
        parent::__construct($config);
    }

}

?>

<?php

/**
 * TestingCssControllerConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class TestingCssControllerConfig extends MQNCssController {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['url_base_path'] = '/MyQuickNet/';
        $config['view_class'] = 'TestingCssView';
        parent::__construct($config);
    }

}

?>

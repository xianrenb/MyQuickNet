<?php

/**
 * TestingCssViewConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingCssViewConfig extends MQNCssView {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $config['cache_max_age'] = 20 * 60;
        $config['column_count'] = 12;
        $config['column_width'] = 60;
        $config['gutter_width'] = 20;
        parent::__construct($config);
    }

}

?>

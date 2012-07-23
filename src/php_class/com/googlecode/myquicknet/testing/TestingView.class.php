<?php

/**
 * TestingView
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingView extends TestingViewConfig {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        parent::__construct($config);
    }

    public function outputJSON() {
        return $this->_outputJSON();
    }

    public function outputHTML() {
        return $this->_outputHTML();
    }

}

?>
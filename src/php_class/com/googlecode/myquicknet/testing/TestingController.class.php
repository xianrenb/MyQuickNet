<?php

/**
 * TestingController
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing;

use com\googlecode\myquicknet\testing_config\TestingControllerConfig;

/**
 *
 */
class TestingController extends TestingControllerConfig {

    /**
     *
     * @var MQNAutoRecord
     */
    private $model;

    /**
     *
     * @var MQNView
     */
    private $view;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        parent::__construct($config);
        $this->model = parent::getModel();
        $this->view = parent::getView();
    }

    /**
     *
     * @return null
     */
    public function run() {
        if (key_exists('PATH_INFO', $_SERVER)) {
            $urlBasePath = (string) preg_quote($this->getUrlBasePath(), '/');
            $subject = (string) $_SERVER['PATH_INFO'];
            $pattern = '/^' . $urlBasePath . 'testing\/advance_example_(.+)\.html$/';

            if (preg_match($pattern, $subject, $matches)) {
                $s = (string) $matches[1];
                $this->view->advanceExample($this->model, $s);
                return;
            }

            $pattern = '/^' . $urlBasePath . 'testing\/get_data\.json$/';

            if (preg_match($pattern, $subject, $matches)) {
                $this->view->getData($this->model);
                return;
            }
        }

        $this->view->output();
    }

}

?>

<?php

/**
 * TestingController
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

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

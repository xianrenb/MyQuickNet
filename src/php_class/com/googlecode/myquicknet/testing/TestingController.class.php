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

    public function run() {
        if (key_exists('PATH_INFO', $_SERVER)) {
            $pattern = (string) preg_quote($this->getUrlBasePath(), '/');
            $pattern = '/^' . $pattern . 'testing\/get_data.json$/';
            $subject = (string) $_SERVER['PATH_INFO'];

            if (preg_match($pattern, $subject, $matches)) {
                $this->model->create();
                $data = array();
                $data['a'] = $this->model->getMyA();
                $data['b'] = $this->model->getMyB();
                $data['c'] = $this->model->getMyC();
                $data['d'] = $this->model->getMyD();
                $this->view->setJSONString(json_encode($data));
                $this->model->delete();
                $this->view->outputJSON();
                return;
            }
        }

        $this->view->output();
    }

}

?>

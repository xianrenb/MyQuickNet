<?php

/**
 * MQNController
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */

/**
 *
 */
class MQNController {

    /**
     *
     * @var MQNAutoRecord
     */
    private $model;

    /**
     *
     * @var string
     */
    private $urlBasePath;

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
        if (key_exists('url_base_path', $config)) {
            $this->urlBasePath = (string) $config['url_base_path'];
        } else {
            $this->urlBasePath = '/';
        }

        if (key_exists('model_class', $config)) {
            $modelClass = (string) $config['model_class'];
            $this->model = new $modelClass();
        } else {
            $this->model = null;
        }

        if (key_exists('view_class', $config)) {
            $viewClass = (string) $config['view_class'];
        } else {
            $viewClass = 'MQNView';
        }

        $this->view = new $viewClass();
    }

    /**
     *
     * @param string $longName
     * @return string
     */
    protected function _toShortName($longName) {
        new String($longName);
        $string = (string) strtolower($longName);
        $shortName = '';
        $n = strlen($string);
        $i = 0;

        while ($i < $n) {
            if ($i) {
                $char = (string) substr($string, $i, 1);

                if ($char == '_') {
                    $nextIsUpper = true;
                } else {
                    if ($nextIsUpper) {
                        $char = (string) strtoupper($char);
                    }

                    $shortName .= (string) $char;
                    $nextIsUpper = false;
                }
            } else {
                $shortName .= (string) strtoupper(substr($string, 0, 1));
                $nextIsUpper = false;
            }

            $i += 1;
        }

        return $shortName;
    }

    /**
     *
     * @return MQNAutoRecord
     */
    public function getModel() {
        return $this->model;
    }

    /**
     *
     * @return string
     */
    public function getUrlBasePath() {
        return $this->urlBasePath;
    }

    /**
     *
     * @return MQNView
     */
    public function getView() {
        return $this->view;
    }

    public function run() {
        if (key_exists('PATH_INFO', $_SERVER)) {
            if ($_SERVER['PATH_INFO'] != $this->getUrlBasePath()) {
                if (key_exists('SERVER_PROTOCOL', $_SERVER)) {
                    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
                }

                header('Status: 404 Not Found');
                return;
            }
        }

        $this->view->output();
    }

}

?>

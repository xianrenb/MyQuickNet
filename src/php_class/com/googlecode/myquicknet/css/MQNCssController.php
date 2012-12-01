<?php

/**
 * MQNCssController
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\css;

use com\googlecode\myquicknet\controller\MQNController;

/**
 *
 */
class MQNCssController extends MQNController {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        parent::__construct($config);
    }

    public function run() {
        if (key_exists('PATH_INFO', $_SERVER)) {
            $pattern = (string) preg_quote($this->getUrlBasePath(), '/');
            $pattern = '/^' . $pattern . '[^\/]+\/(.*).css$/';
            $subject = (string) $_SERVER['PATH_INFO'];

            if (preg_match($pattern, $subject, $matches)) {
                switch ($matches[1]) {
                    case 'grid':
                        if ($this->getView()->outputGrid()) {
                            return;
                        }

                        break;
                    case 'reset':
                        if ($this->getView()->outputReset()) {
                            return;
                        }

                        break;
                    default:
                }
            }
        }

        $config = array('url_base_path' => $this->getUrlBasePath());
        $controller = new MQNController($config);
        $controller->run();
    }

}

?>

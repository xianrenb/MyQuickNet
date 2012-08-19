<?php

/**
 * MQNMainController
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

/**
 *
 */
class MQNMainController extends MQNController {

    /**
     *
     * @var string
     */
    private $mainControllerClass;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        parent::__construct($config);
        if (key_exists('main_controller_class', $config)) {
            $this->mainControllerClass = (string) $config['main_controller_class'];
        } else {
            $this->mainControllerClass = 'MQNMainController';
        }
    }

    public function run() {
        if (key_exists('PATH_INFO', $_SERVER)) {
            $pattern = (string) preg_quote($this->getUrlBasePath(), '/');
            $pattern = '/^' . $pattern . '([^\/]+)\/.*$/';
            $subject = (string) $_SERVER['PATH_INFO'];

            if (preg_match($pattern, $subject, $matches)) {
                $controllerClassName = (string) $this->_toShortName($matches[1]);
                $controllerClassName .= 'Controller';
                $controllerExists = false;

                try {
                    if (class_exists($controllerClassName, true)) {
                        if (is_subclass_of($controllerClassName, 'MQNController')) {
                            if (strtolower($controllerClassName) != strtolower('MQNMainController')) {
                                if (strtolower($controllerClassName) != strtolower($this->mainControllerClass)) {
                                    $controllerExists = true;
                                }
                            }
                        }
                    }
                } catch (Exception $e) {
                    $controllerExists = false;
                }

                if ($controllerExists) {
                    $controller = new $controllerClassName();
                    $controller->run();
                    return;
                }
            }
        }

        $config = array('url_base_path' => $this->getUrlBasePath());
        $controller = new MQNController($config);
        $controller->run();
    }

}

?>

<?php

/**
 * MQNMainController
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\controller;

/**
 *
 */
class MQNMainController extends MQNController
{
    /**
     *
     * @var string
     */
    private $controllerClassPrefix;

    /**
     *
     * @var string
     */
    private $mainControllerClass;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);

        if (array_key_exists('controller_class_prefix', $config)) {
            $this->controllerClassPrefix = (string) $config['controller_class_prefix'];
        } else {
            $this->controllerClassPrefix = '\\com\\googlecode\\myquicknet\\controller\\';
        }

        if (array_key_exists('main_controller_class', $config)) {
            $this->mainControllerClass = (string) $config['main_controller_class'];
        } else {
            $this->mainControllerClass = '\\com\\googlecode\\myquicknet\\controller\\MQNMainController';
        }
    }

    public function run()
    {
        if (key_exists('PATH_INFO', $_SERVER)) {
            $pattern = (string) preg_quote($this->getUrlBasePath(), '/');
            $pattern = '/^' . $pattern . '([^\/]+)\/.*$/';
            $subject = (string) $_SERVER['PATH_INFO'];

            if (preg_match($pattern, $subject, $matches)) {
                $controllerClassName = (string) $this->controllerClassPrefix;
                $controllerClassName .= (string) $this->_toShortName($matches[1]);
                $controllerClassName .= 'Controller';
                $controllerExists = false;

                try {
                    if (class_exists($controllerClassName, true)) {
                        if (is_subclass_of($controllerClassName, '\\com\\googlecode\\myquicknet\\controller\\MQNController')) {
                            if (strtolower($controllerClassName) != strtolower('\\com\\googlecode\\myquicknet\\controller\\MQNMainController')) {
                                if (strtolower($controllerClassName) != strtolower($this->mainControllerClass)) {
                                    $controllerExists = true;
                                }
                            }
                        }
                    }
                } catch (\Exception $e) {
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

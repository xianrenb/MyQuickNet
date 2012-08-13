<?php

/**
 * config
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
call_user_func(function () {
            // Settings for PHP
            set_error_handler(function ($a, $b, $c, $d) {
                        throw new ErrorException($b, 0, $a, $c, $d);
                    });

            mb_internal_encoding('UTF-8');
            mb_regex_encoding('UTF-8');
            date_default_timezone_set('Asia/Hong_Kong');
            // Uncomment the following line when using mod_suphp
            // $_SERVER['PATH_INFO'] = (string) preg_replace('/^([^?]*).*$/', '\1', $_SERVER['REQUEST_URI']);
            // Define MyQuickNet base path constant
            define('MQN_BASE_PATH', (string) (__DIR__ . '/'));
            // Set include path
            $path = (string) get_include_path();
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/autorecord/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/controller/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/css/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/database/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/dom/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/scalar/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/static_file/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/testing/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/testing_config/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/com/googlecode/myquicknet/view/');
            // $path .= (string) (PATH_SEPARATOR . 'additional/path/');
            set_include_path($path);

            spl_autoload_register(function ($class_name) {
                        include_once($class_name . '.class.php');
                    });
        });
?>
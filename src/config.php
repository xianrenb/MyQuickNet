<?php

/**
 * config
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
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
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_class/');
            $path .= (string) (PATH_SEPARATOR . MQN_BASE_PATH . 'php_global_class/');
            // $path .= (string) (PATH_SEPARATOR . 'additional/path/');
            set_include_path($path);

            spl_autoload_register(function ($class_name) {
                        include_once($class_name . '.class.php');
                    });
        });
?>
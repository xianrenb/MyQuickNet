<?php

/**
 * config
 * @package MyQuickNet
 * @version 5.0
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
call_user_func(
        function () {
            // Settings for PHP
            set_error_handler(
                    function ($errno, $errstr, $errfile, $errline) {
                        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
                    }
            );

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

            spl_autoload_register(
                    function ($className) {
                        $className = ltrim($className, '\\');
                        $fileName = '';
                        $namespace = '';

                        if ($lastNsPos = strrpos($className, '\\')) {
                            $namespace = substr($className, 0, $lastNsPos);
                            $className = substr($className, $lastNsPos + 1);
                            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
                        }

                        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
                        require $fileName;
                    }
            );
        }
);

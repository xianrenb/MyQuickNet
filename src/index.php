<?php

/**
 * index
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
call_user_func(function () {
            require_once(__DIR__ . '/config.php');

            try {
                ob_start();
                $controller = new \com\googlecode\myquicknet\testing\TestingMainController();
                $controller->run();
                ob_end_flush();
            } catch (\Exception $e) {
                ob_end_clean();
                $error = '[';
                $error .= (string) date(DATE_W3C);
                $error .= ']';
                $error .= (string) $e;
                $error .= "\n";

                try {
                    $errorLog = fopen(__DIR__ . '/error.log', 'c');

                    if (flock($errorLog, LOCK_EX)) {
                        fseek($errorLog, 0, SEEK_END);
                        fwrite($errorLog, $error);
                        fflush($errorLog);
                        flock($errorLog, LOCK_UN);
                    }

                    fclose($errorLog);
                } catch (\Exception $e) {
                    
                }

                if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
                    $status = (string) ($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                    header($status);
                    header('Status: 500 Internal Server Error');
                    echo($status);
                } else {
                    header('Status: 500 Internal Server Error');
                    echo('Status: 500 Internal Server Error');
                }
            }
        });
?>
<?php

/**
 * index
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
call_user_func(function () {
            require_once(dirname(__FILE__) . '/config.php');

            try {
                ob_start();
                $controller = new TestingMainController();
                $controller->run();
                ob_end_flush();
            } catch (Exception $e) {
                ob_end_clean();

                if (key_exists('SERVER_PROTOCOL', $_SERVER)) {
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
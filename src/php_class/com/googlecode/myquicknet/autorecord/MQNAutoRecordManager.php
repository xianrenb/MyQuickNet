<?php

/**
 * MQNAutoRecordManager
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\database\MQNDatabase;

/**
 *
 */
class MQNAutoRecordManager {

    /**
     *
     * @var MQNDatabase
     */
    private static $database = null;

    /**
     *
     * @var int
     */
    private static $instance_created_count = 0;

    /**
     *
     * @var int
     */
    private static $instance_destroyed_count = 0;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        if (!self::$instance_created_count) {
            $dbClass = (string) $config['db_class'];
            self::$database = new $dbClass($config);

            if (self::$database instanceof MQNDatabase) {
                self::$database->connect();
            } else {
                self::$database = null;
                throw new \UnexpectedValueException();
            }
        }

        self::$instance_created_count += 1;
    }

    public function __destruct() {
        self::$instance_destroyed_count += 1;

        if (self::$instance_created_count == self::$instance_destroyed_count) {
            self::$instance_created_count = 0;
            self::$instance_destroyed_count = 0;

            if (self::$database->commit()) {
                self::$database->close();
                self::$database = null;
            } else {
                self::$database = null;
                throw new \Exception('Could not commit database.');
            }
        }
    }

    /**
     *
     * @return MQNDatabase
     */
    public function getDatabase() {
        return self::$database;
    }

}

?>

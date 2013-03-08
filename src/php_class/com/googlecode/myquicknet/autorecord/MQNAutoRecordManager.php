<?php

/**
 * MQNAutoRecordManager
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\database\MQNDatabase;

/**
 *
 */
class MQNAutoRecordManager
{
    /**
     *
     * @var int
     */
    private $bindedCount;

    /**
     *
     * @var array
     */
    private $config;

    /**
     *
     * @var MQNDatabase
     */
    private $database;

    /**
     *
     * @var array
     */
    private static $instanceArray = array();

    /**
     *
     * @var int
     */
    private $unBindedCount;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $this->bindedCount = 0;
        $this->config = $config;
        $this->database = null;
        $this->unBindedCount = 0;
    }

    /**
     *
     * @throws \UnexpectedValueException
     */
    public function bind()
    {
        if (!$this->bindedCount) {
            $dbClass = (string) $this->config['db_class'];
            $this->database = new $dbClass($this->config);

            if ($this->database instanceof MQNDatabase) {
                $this->database->connect();
            } else {
                $this->database = null;
                throw new \UnexpectedValueException();
            }
        }

        $this->bindedCount += 1;
    }

    /**
     *
     * @throws \Exception
     */
    public function unbind()
    {
        $this->unBindedCount += 1;

        if ($this->bindedCount == $this->unBindedCount) {
            $this->bindedCount = 0;
            $this->unBindedCount = 0;

            if ($this->database->commit()) {
                $this->database->close();
                $this->database = null;
            } else {
                $this->database = null;
                throw new \Exception('Could not commit database.');
            }
        }
    }

    /**
     *
     * @return MQNDatabase
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     *
     * @return MQNAutoRecordManager
     */
    public static function getInstance()
    {
        $calledClass = (string) get_called_class();

        if (!array_key_exists($calledClass, self::$instanceArray)) {
            self::$instanceArray[$calledClass] = new $calledClass;
        }

        return self::$instanceArray[$calledClass];
    }

}

<?php

/**
 * MQNAutoRecordCache
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

/**
 *
 */
class MQNAutoRecordCache extends MQNAutoRecord {

    /**
     *
     * @var string
     */
    private $autoRecordManagerClass;

    /**
     *
     * @var MQNAutoRecord
     */
    private $cache;

    /**
     *
     * @var array
     */
    private static $cacheArray = array();

    /**
     *
     * @var array
     */
    private $config;

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var array
     */
    private static $refCountArray = array();

    /**
     *
     * @var string
     */
    private $table;

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $this->autoRecordManagerClass = (string) $config['auto_record_manager_class'];
        $this->config = $config;
        $this->id = 0;
        $this->table = (string) $config['table'];
        $this->cache = new parent($config);
    }

    /**
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments) {
        new \String($name);
        $this->id = (int) $this->cache->getId();
        $result = $this->cache->__call($name, $arguments);
        return $result;
    }

    /**
     * 
     */
    public function __destruct() {
        $this->id = (int) $this->cache->getId();
        $this->_unbindCache();
        $this->cache = null;
    }

    /**
     *
     * @return boolean 
     */
    protected function _bindCache() {
        if ($this->id) {
            if (!array_key_exists($this->autoRecordManagerClass, self::$refCountArray)) {
                self::$refCountArray[$this->autoRecordManagerClass] = array();
                self::$cacheArray[$this->autoRecordManagerClass] = array();
            }

            if (!array_key_exists($this->table, self::$refCountArray[$this->autoRecordManagerClass])) {
                self::$refCountArray[$this->autoRecordManagerClass][$this->table] = array();
                self::$cacheArray[$this->autoRecordManagerClass][$this->table] = array();
            }

            if (array_key_exists($this->id, self::$refCountArray[$this->autoRecordManagerClass][$this->table])) {
                self::$refCountArray[$this->autoRecordManagerClass][$this->table][$this->id] += 1;
                $this->cache = self::$cacheArray[$this->autoRecordManagerClass][$this->table][$this->id];
                $success = true;
            } else {
                $success = false;
            }

            return $success;
        }
    }

    /**
     *
     * @param MQNAutoRecord $cache 
     */
    protected function _createCache($cache) {
        $this->id = $cache->getId();
        $this->cache = $cache;

        if ($this->id) {
            if (!array_key_exists($this->autoRecordManagerClass, self::$refCountArray)) {
                self::$refCountArray[$this->autoRecordManagerClass] = array();
                self::$cacheArray[$this->autoRecordManagerClass] = array();
            }

            if (!array_key_exists($this->table, self::$refCountArray[$this->autoRecordManagerClass])) {
                self::$refCountArray[$this->autoRecordManagerClass][$this->table] = array();
                self::$cacheArray[$this->autoRecordManagerClass][$this->table] = array();
            }

            self::$refCountArray[$this->autoRecordManagerClass][$this->table][$this->id] = 1;
            self::$cacheArray[$this->autoRecordManagerClass][$this->table][$this->id] = $cache;
        }
    }

    /**
     *
     * @param string $name
     * @throws BadMethodCallException 
     */
    protected function _getField($name) {
        new \String($name);
        throw new \BadMethodCallException();
    }

    /**
     *
     * @param bool $newValid
     * @throws BadMethodCallException 
     */
    protected function _getNewId($newValid) {
        new \Bool($newValid);
        throw new \BadMethodCallException();
    }

    /**
     *
     * @param string $name
     * @param mixed $value
     * @throws BadMethodCallException 
     */
    protected function _setField($name, $value) {
        new \String($name);
        throw new \BadMethodCallException();
    }

    /**
     * 
     */
    protected function _unbindCache() {
        $this->id = (int) $this->cache->getId();

        if ($this->id) {
            self::$refCountArray[$this->autoRecordManagerClass][$this->table][$this->id] -= 1;

            if (self::$refCountArray[$this->autoRecordManagerClass][$this->table][$this->id] <= 0) {
                unset(self::$refCountArray[$this->autoRecordManagerClass][$this->table][$this->id]);
                self::$cacheArray[$this->autoRecordManagerClass][$this->table][$this->id] = null;
                unset(self::$cacheArray[$this->autoRecordManagerClass][$this->table][$this->id]);

                if (!count(self::$refCountArray[$this->autoRecordManagerClass][$this->table])) {
                    unset(self::$refCountArray[$this->autoRecordManagerClass][$this->table]);
                    unset(self::$cacheArray[$this->autoRecordManagerClass][$this->table]);

                    if (!count(self::$refCountArray[$this->autoRecordManagerClass])) {
                        unset(self::$refCountArray[$this->autoRecordManagerClass]);
                        unset(self::$cacheArray[$this->autoRecordManagerClass]);
                    }
                }
            }
        }
    }

    /**
     * 
     */
    public function create() {
        $this->id = (int) $this->cache->getId();
        $this->_unbindCache();
        $cache = new parent($this->config);
        $cache->create();
        $this->_createCache($cache);
    }

    /**
     * 
     */
    public function delete() {
        $this->id = (int) $this->cache->getId();

        if ($this->id) {
            $this->cache->delete();
            unset(self::$refCountArray[$this->autoRecordManagerClass][$this->table][$this->id]);
            self::$cacheArray[$this->autoRecordManagerClass][$this->table][$this->id] = null;
            unset(self::$cacheArray[$this->autoRecordManagerClass][$this->table][$this->id]);
            $this->id = 0;

            if (!count(self::$refCountArray[$this->autoRecordManagerClass][$this->table])) {
                unset(self::$refCountArray[$this->autoRecordManagerClass][$this->table]);
                unset(self::$cacheArray[$this->autoRecordManagerClass][$this->table]);

                if (!count(self::$refCountArray[$this->autoRecordManagerClass])) {
                    unset(self::$refCountArray[$this->autoRecordManagerClass]);
                    unset(self::$cacheArray[$this->autoRecordManagerClass]);
                }
            }
        }
    }

    /**
     *
     * @return MQNDatabase
     */
    public function getDatabase() {
        $this->id = (int) $this->cache->getId();
        $database = $this->cache->getDatabase();
        return $database;
    }

    /**
     *
     * @return int
     */
    public function getId() {
        $this->id = (int) $this->cache->getId();
        $id = (int) $this->cache->getId();
        return $id;
    }

    /**
     *
     * @return string
     */
    public function getTable() {
        $this->id = (int) $this->cache->getId();
        $table = (string) $this->cache->getTable();
        return $table;
    }

    /**
     *
     * @return bool
     */
    public function isValid() {
        $this->id = (int) $this->cache->getId();
        $isValid = (bool) $this->cache->isValid();
        return $isValid;
    }

    /**
     *
     * @param int $id
     */
    public function read($id) {
        new \Int($id);
        $this->id = (int) $this->cache->getId();
        $this->_unbindCache();
        $this->id = (int) $id;

        if (!$this->_bindCache()) {
            $cache = new parent($this->config);
            $cache->read($id);
            $this->_createCache($cache);
        };
    }

    /**
     * 
     */
    public function update() {
        $this->id = (int) $this->cache->getId();
        $this->cache->update();
    }

}

?>

<?php

/**
 * MQNAutoRecord
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\database\MQNBlob;
use com\googlecode\myquicknet\scalar\Bool;
use com\googlecode\myquicknet\scalar\Int;
use com\googlecode\myquicknet\scalar\String;

/**
 *
 */
class MQNAutoRecord
{
    /**
     *
     * @var MQNAutoRecordManager
     */
    private $autoRecordManager;

    /**
     *
     * @var bool
     */
    private $autoUpdate;

    /**
     *
     * @var MQNDatabase
     */
    private $database;

    /**
     *
     * @var array
     */
    private $defaultFieldArray;

    /**
     *
     * @var bool
     */
    private $dirty;

    /**
     *
     * @var array
     */
    private $fieldArray;

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $table;

    /**
     *
     * @var bool
     */
    private $valid;

    /**
     *
     * @param  array                     $config
     * @throws \UnexpectedValueException
     */
    public function __construct(array $config = array())
    {
        $autoRecordManagerClass = (string) $config['auto_record_manager_class'];
        $this->autoRecordManager = $autoRecordManagerClass::getInstance();
        $this->autoRecordManager->bind();
        $this->autoUpdate = true;
        $this->database = $this->autoRecordManager->getDatabase();
        $this->defaultFieldArray = $config['field_array'];
        $this->dirty = false;
        $this->fieldArray = array();

        foreach ($this->defaultFieldArray as $name => $value) {
            if (is_scalar($value)) {
                $this->fieldArray[$name] = $value;
            } elseif ($value instanceof MQNBlob) {
                $this->fieldArray[$name] = clone $value;
            } else {
                throw new \UnexpectedValueException();
            }
        }

        $this->id = 0;
        $this->table = (string) $config['table'];
        $this->valid = false;
    }

    /**
     *
     * @param  string                  $name
     * @param  array                   $arguments
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($name, $arguments)
    {
        new String($name);

        try {
            if (preg_match('/^get/', $name)) {
                sscanf($name, 'get%s', $shortFieldName);
                $fieldName = (string) MQNAutoRecordTools::shortFieldNameToFieldName($shortFieldName);

                return $this->_getField($fieldName);
            } elseif (preg_match('/^set/', $name)) {
                sscanf($name, 'set%s', $shortFieldName);
                $fieldName = (string) MQNAutoRecordTools::shortFieldNameToFieldName($shortFieldName);
                $value = $arguments[0];
                $this->_setField($fieldName, $value);
            } else {
                throw new \InvalidArgumentException();
            }
        } catch (\InvalidArgumentException $e) {
            throw new \BadMethodCallException();
        }
    }

    /**
     *
     */
    public function __destruct()
    {
        if ($this->autoUpdate && $this->dirty) {
            $this->update();
        }

        $this->database = null;
        $this->autoRecordManager->unbind();
        $this->autoRecordManager = null;
    }

    /**
     *
     * @param  string                    $name
     * @return bool|float|int|string
     * @throws \InvalidArgumentException
     */
    protected function _getField($name)
    {
        new String($name);

        if (!array_key_exists($name, $this->fieldArray)) {
            throw new \InvalidArgumentException();
        }

        return $this->fieldArray[$name];
    }

    /**
     *
     * @param  bool $newValid
     * @return int
     */
    protected function _getNewId($newValid)
    {
        new Bool($newValid);
        // try to find the smallest invalid id, which could be reused
        $sql = 'SELECT `id` FROM `';
        $sql .= (string) $this->table;
        $sql .= '` WHERE `valid` = ';
        $sql .= '0';
        $sql .= ' ORDER BY `id`';
        $rows = $this->database->queryLimitForUpdate($sql, 1);

        if (count($rows)) {
            $id = (int) $rows[0]['id'];
            $sql = 'UPDATE `';
            $sql .= (string) $this->table;
            $sql .= '` SET `valid` = ?';
            $sql .= ' WHERE `id` = ?';
            $statement = $this->database->prepare($sql);
            $statement->appendBindValueArray($newValid);
            $statement->appendBindValueArray($id);
            $statement->execute();
            $statement = null;

            return $id;
        }

        // try to find the biggest id
        $sql = 'SELECT `id` FROM `';
        $sql .= (string) $this->table;
        $sql .= '` ORDER BY `id` DESC';
        $rows = $this->database->queryLimitForUpdate($sql, 1);

        if (count($rows)) {
            // next id
            $id = (int) $rows[0]['id'];
            $id += 1;
        } else {
            // no record in table!
            $id = 1;
        }

        // insert an (invalid) record with the new id
        $sql = 'INSERT INTO `';
        $sql .= (string) $this->table;
        $sql .= '` ( `id` , `valid`';

        foreach ($this->fieldArray as $name => $value) {
            $sql .= ' , `';
            $sql .= (string) $name;
            $sql .= '`';
        }

        $sql .= ' ) VALUES ( ';
        $sql .= '? , ?';

        foreach ($this->fieldArray as $value) {
            $sql .= ' , ?';
        }

        $sql .= ' )';
        $statement = $this->database->prepare($sql);
        $statement->appendBindValueArray($id);
        $statement->appendBindValueArray($newValid);

        foreach ($this->fieldArray as $value) {
            $statement->appendBindValueArray($value);
        }

        $statement->execute();
        $statement = null;

        return $id;
    }

    /**
     *
     * @param  string                              $name
     * @param  bool|float|int|string|MQNAutoRecord $value
     * @throws \Exception
     * @throws \InvalidArgumentException
     */
    protected function _setField($name, $value)
    {
        new String($name);

        if (!array_key_exists($name, $this->fieldArray)) {
            throw new \InvalidArgumentException();
        }

        if (is_scalar($value)) {
            $oldValue = $this->fieldArray[$name];

            if (is_bool($oldValue)) {
                $this->fieldArray[$name] = (bool) $value;
            } elseif (is_float($oldValue)) {
                $this->fieldArray[$name] = (float) $value;
            } elseif (is_int($oldValue)) {
                $this->fieldArray[$name] = (int) $value;
            } elseif (is_string($oldValue)) {
                $this->fieldArray[$name] = (string) $value;
            } else {
                throw new \Exception('Type not supported.');
            }
        } elseif ($value instanceof MQNBlob) {
            if ($this->fieldArray[$name] instanceof MQNBlob) {
                $this->fieldArray[$name] = clone $value;
            } else {
                throw new \Exception('Type not supported.');
            }
        } elseif ($value instanceof MQNAutoRecord) {
            if (is_int($this->fieldArray[$name])) {
                $this->fieldArray[$name] = (int) $value->getId();
            } else {
                throw new \Exception('Type not supported.');
            }
        } else {
            throw new \InvalidArgumentException();
        }

        $this->dirty = true;
    }

    /**
     *
     * @throws \UnexpectedValueException
     */
    public function create()
    {
        $this->autoUpdate = true;
        $this->dirty = true;
        $this->id = (int) $this->_getNewId(true);
        $this->valid = true;
        $this->fieldArray = array();

        foreach ($this->defaultFieldArray as $name => $value) {
            if (is_scalar($value)) {
                $this->fieldArray[$name] = $value;
            } elseif ($value instanceof MQNBlob) {
                $this->fieldArray[$name] = clone $value;
            } else {
                throw new \UnexpectedValueException();
            }
        }
    }

    /**
     *
     */
    public function delete()
    {
        $this->valid = false;
        $this->update();
        $this->autoUpdate = true;
        $this->dirty = true;
        $this->id = 0;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     *
     * @param  int        $id
     * @throws \Exception
     */
    public function read($id)
    {
        new Int($id);

        if ($this->autoUpdate && $this->dirty) {
            $this->update();
        }

        $this->autoUpdate = true;
        $this->dirty = false;
        $this->id = (int) $id;
        $this->valid = true;
        $sql = 'SELECT * FROM `';
        $sql .= (string) $this->table;
        $sql .= '` WHERE ';
        $sql .= '`id` = ?';
        $sql .= ' AND `valid` = 1';
        $statement = $this->database->prepareLimitForUpdate($sql, 1);
        $statement->appendBindValueArray($this->id);
        $rows = $statement->execute();
        $statement = null;

        if (count($rows)) {
            foreach ($this->fieldArray as $name => $oldValue) {
                if (is_bool($oldValue)) {
                    $this->fieldArray[$name] = (bool) $rows[0][$name];
                } elseif (is_float($oldValue)) {
                    $this->fieldArray[$name] = (float) $rows[0][$name];
                } elseif (is_int($oldValue)) {
                    $this->fieldArray[$name] = (int) $rows[0][$name];
                } elseif (is_string($oldValue)) {
                    $this->fieldArray[$name] = (string) $rows[0][$name];
                } elseif ($oldValue instanceof MQNBlob) {
                    $blob = (string) $rows[0][$name];
                    $this->fieldArray[$name] = new MQNBlob($blob);
                } else {
                    throw new \Exception('Type not supported.');
                }
            }
        } else {
            $this->id = 0;
            $this->valid = false;
        }
    }

    /**
     *
     * @return null
     * @throws \Exception
     */
    public function update()
    {
        $id = (int) $this->getId();
        $valid = (bool) $this->isValid();

        if ($id == 0) {
            return;
        }

        $sql = 'UPDATE `';
        $sql .= (string) $this->table;
        $sql .= '` SET `valid` = ?';

        foreach ($this->fieldArray as $name => $value) {
            $sql .= ' , `';
            $sql .= (string) $name;
            $sql .= '` = ?';
        }

        $sql .= ' WHERE `id` = ?';
        $statement = $this->database->prepare($sql);
        $statement->appendBindValueArray($valid);

        foreach ($this->fieldArray as $value) {
            $statement->appendBindValueArray($value);
        }

        $statement->appendBindValueArray($id);
        $statement->execute();
        $statement = null;
        $this->dirty = false;
    }

}

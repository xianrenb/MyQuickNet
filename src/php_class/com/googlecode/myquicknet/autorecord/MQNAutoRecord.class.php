<?php

/**
 * MQNAutoRecord
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class MQNAutoRecord {

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
     * @param array $config
     */
    public function __construct(array $config = array()) {
        $autoRecordManagerClass = (string) $config['auto_record_manager_class'];
        $this->autoRecordManager = new $autoRecordManagerClass($config);
        $this->autoUpdate = true;
        $this->database = $this->autoRecordManager->getDatabase();
        $this->defaultFieldArray = $config['field_array'];
        $this->dirty = false;
        $this->fieldArray = $this->defaultFieldArray;
        $this->id = 0;
        $this->table = (string) $config['table'];
        $this->valid = false;
    }

    public function __call($name, $arguments) {
        if (preg_match('/^get/', $name)) {
            sscanf($name, 'get%s', $shortFieldName);
            $fieldName = (string) MQNAutoRecordTools::shortFieldNameToFieldName($shortFieldName);
            return $this->_getField($fieldName);
        } else if (preg_match('/^set/', $name)) {
            sscanf($name, 'set%s', $shortFieldName);
            $fieldName = (string) MQNAutoRecordTools::shortFieldNameToFieldName($shortFieldName);
            $value = $arguments[0];
            $this->_setField($fieldName, $value);
        }
    }

    public function __destruct() {
        if ($this->autoUpdate && $this->dirty) {
            $this->update();
        }

        $this->database = null;
        $this->autoRecordManager = null;
    }

    /**
     *
     * @param string $name
     * @return bool|float|int|string
     */
    protected function _getField($name) {
        new String($name);
        return $this->fieldArray[$name];
    }

    /**
     *
     * @param bool $newValid
     * @return int
     */
    protected function _getNewId($newValid) {
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
            $sql .= '` SET `valid` = ';
            $sql .= (int) $newValid;
            $sql .= ' WHERE `id` = ';
            $sql .= (int) $id;
            $this->database->query($sql);
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
        $sql .= '` ( `id` , `valid` )';
        $sql .= ' VALUES ( ';
        $sql .= (int) $id;
        $sql .= ' , ';
        $sql .= (int) $newValid;
        $sql .= ' )';
        $this->database->query($sql);
        return $id;
    }

    /**
     *
     * @param string $name
     * @param bool|float|int|string|MQNAutoRecord $value
     */
    protected function _setField($name, $value) {
        new String($name);

        if (is_scalar($value)) {
            $oldValue = $this->fieldArray[$name];

            if (is_bool($oldValue)) {
                $this->fieldArray[$name] = (bool) $value;
            } else if (is_float($oldValue)) {
                $this->fieldArray[$name] = (float) $value;
            } else if (is_int($oldValue)) {
                $this->fieldArray[$name] = (int) $value;
            } else if (is_string($oldValue)) {
                $this->fieldArray[$name] = (string) $value;
            } else {
                throw new Exception('Type not supported.');
            }
        } else if ($value instanceof MQNAutoRecord) {
            if (is_int($this->fieldArray[$name])) {
                $this->fieldArray[$name] = (int) $value->getId();
            } else {
                throw new Exception('Type not supported.');
            }
        } else {
            throw new InvalidArgumentException();
        }

        $this->dirty = true;
    }

    public function create() {
        $this->autoUpdate = true;
        $this->dirty = true;
        $this->id = (int) $this->_getNewId(true);
        $this->valid = true;
        $this->fieldArray = $this->defaultFieldArray;
    }

    public function delete() {
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
    public function getDatabase() {
        return $this->database;
    }

    /**
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @return string
     */
    public function getTable() {
        return $this->table;
    }

    /**
     *
     * @return bool
     */
    public function isValid() {
        return $this->valid;
    }

    /**
     *
     * @param int $id
     */
    public function read($id) {
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
        $sql .= '`id` = ';
        $sql .= (int) $this->id;
        $sql .= ' AND `valid` = 1';
        $rows = $this->database->queryLimitForUpdate($sql, 1);

        if (count($rows)) {
            foreach ($this->fieldArray as $name => $oldValue) {
                if (is_bool($oldValue)) {
                    $this->fieldArray[$name] = (bool) $rows[0][$name];
                } else if (is_float($oldValue)) {
                    $this->fieldArray[$name] = (float) $rows[0][$name];
                } else if (is_int($oldValue)) {
                    $this->fieldArray[$name] = (int) $rows[0][$name];
                } else if (is_string($oldValue)) {
                    $this->fieldArray[$name] = (string) $rows[0][$name];
                } else {
                    throw new Exception('Type not supported.');
                }
            }
        } else {
            $this->id = 0;
            $this->valid = false;
        }
    }

    public function update() {
        $id = (int) $this->getId();
        $valid = (bool) $this->isValid();

        if ($id == 0) {
            return;
        }

        $sql = 'UPDATE `';
        $sql .= (string) $this->table;
        $sql .= '` SET `valid` = ';
        $sql .= (int) $valid;

        foreach ($this->fieldArray as $name => $value) {
            $sql .= ' , `';
            $sql .= (string) $name;
            $sql .= '` = ';

            if (is_bool($value)) {
                $sql .= (int) $value;
            } else if (is_float($value)) {
                $sql .= (float) $value;
            } else if (is_int($value)) {
                $sql .= (int) $value;
            } else if (is_string($value)) {
                $sql .= '\'';
                $sql .= (string) $this->database->escapeString($value);
                $sql .= '\'';
            } else {
                throw new Exception('Type not supported.');
            }
        }

        $sql .= ' WHERE `id` = ';
        $sql .= (int) $id;
        $this->database->query($sql);
        $this->dirty = false;
    }

}

?>

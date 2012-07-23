<?php

/**
 * TestingAutoRecordManagerConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class TestingAutoRecordManagerConfig extends MQNAutoRecordManager {

    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array()) {
        //Settings for using SQLite3
        $config['db_class'] = 'MQNDatabaseSQLite';
        $config['db_filename'] = (string) (MQN_BASE_PATH . 'sqlite/mqntestdb.sqlite3');

        //Settings for using MySQLi
        /*
          if (array_key_exists('OPENSHIFT_APP_NAME', $_ENV)) {
          $config['db_class'] = 'MQNDatabaseMySQLi';
          $config['db_host'] = (string) $_ENV['OPENSHIFT_DB_HOST'];
          $config['db_port'] = (string) $_ENV['OPENSHIFT_DB_PORT'];
          $config['db_name'] = (string) $_ENV['OPENSHIFT_APP_NAME'];
          $config['db_user'] = (string) $_ENV['OPENSHIFT_DB_USERNAME'];
          $config['db_password'] = (string) $_ENV['OPENSHIFT_DB_PASSWORD'];
          } else {
          $config['db_class'] = 'MQNDatabaseMySQLi';
          $config['db_host'] = 'localhost';
          $config['db_port'] = '';
          $config['db_name'] = 'mqntestdb';
          $config['db_user'] = 'mqntestdbuser';
          $config['db_password'] = 'mqntest';
          }
         * 
         */

        parent::__construct($config);
    }

}

?>

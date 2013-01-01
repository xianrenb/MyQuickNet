<?php

/**
 * TestingAutoRecordManagerConfig
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\testing_config;

use com\googlecode\myquicknet\autorecord\MQNAutoRecordManager;

/**
 *
 */
class TestingAutoRecordManagerConfig extends MQNAutoRecordManager
{
    /**
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        //Settings for using SQLite3
        $config['db_class'] = '\\com\\googlecode\\myquicknet\\database\\MQNDatabaseSQLite';
        $config['db_filename'] = (string) (MQN_BASE_PATH . 'sqlite/mqntestdb.sqlite3');

        //Settings for using MySQLi
        /*
          if (array_key_exists('OPENSHIFT_APP_NAME', $_ENV)) {
          $config['db_class'] = '\\com\\googlecode\\myquicknet\\database\\MQNDatabaseMySQLi';
          $config['db_host'] = (string) $_ENV['OPENSHIFT_MYSQL_DB_HOST'];
          $config['db_port'] = (string) $_ENV['OPENSHIFT_MYSQL_DB_PORT'];
          $config['db_name'] = (string) $_ENV['OPENSHIFT_APP_NAME'];
          $config['db_user'] = (string) $_ENV['OPENSHIFT_MYSQL_DB_USERNAME'];
          $config['db_password'] = (string) $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD'];
          } else {
          $config['db_class'] = '\\com\\googlecode\\myquicknet\\database\\MQNDatabaseMySQLi';
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

<?php
/**
 * Singleton
 *
 * @class models/DBDriver
 */
namespace core;


abstract class DBDriver {
    protected $_db;
    protected static $_instance;

    public static function getInstance(){
        if(is_null(static::$_instance)) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    protected function __clone(){}
    protected function __wakeup(){}
    abstract protected function __construct();


    abstract public function create($table, $params);
    abstract public function read($table, $params);
    abstract public function update($table, $params);
    abstract public function delete($table, $params);

    abstract protected function parseParams($params);
}
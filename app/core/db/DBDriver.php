<?php
/**
 * Singleton
 *
 * @class \core\db\DBDriver
 */
namespace core\db;

abstract class DBDriver {
    protected $_db;
    protected static $_instance;

    const TYPE_CREATE = 'create';
    const TYPE_READ = 'read';
    const TYPE_UPDATE = 'update';
    const TYPE_DELETE = 'delete';

    public static function getInstance(){
        if(is_null(static::$_instance)) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    protected function __clone(){}
    protected function __wakeup(){}
    abstract protected function __construct();


    abstract protected function create($table, $params);
    abstract protected function read($table, $params);
    abstract protected function update($table, $params);
    abstract protected function delete($table, $params);

    abstract public function query($type, $table, $params);
}
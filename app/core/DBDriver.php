<?php
/**
 * @class models/DBDriver
 */
namespace core;


abstract class DBDriver {
    protected $_connection;

    abstract public function create($table, $params);
    abstract public function read($table, $params);
    abstract public function update($table, $params);
    abstract public function delete($table, $params);

    abstract protected function parseParams($params);
}
<?php
/**
 * @class \core\Model
 */
namespace core;

class Model {

    protected $_driver;

    protected $_table;

    public function __construct(DBDriver $driver) {
        $this->_driver = $driver;
    }

    public function create($params) {

    }

    public function read($params) {

    }

    public function update($params) {

    }

    public function delete($params) {

    }
}
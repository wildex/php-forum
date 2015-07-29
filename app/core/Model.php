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

    public function create() {

    }

    public function read() {

    }

    public function update() {

    }

    public function delete() {

    }
}
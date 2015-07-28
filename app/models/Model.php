<?php
namespace models;

use core;

class Model {

    private $_driver;

    protected $_table;

    public function __construct(core\DBDriver $driver) {
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
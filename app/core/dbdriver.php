<?php
/**
 * @class models/DBDriver
 */
namespace core;


abstract class DBDriver {
    abstract public function create();
    abstract public function read();
    abstract public function update();
    abstract public function delete();
}
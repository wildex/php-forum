<?php
/**
 *
 * @class Registry
 */

namespace core;


class Registry {
    private $_registry = [];

    public function set($key, $val) {
        if(array_key_exists($key, $this->_registry)) {
            throw new \Exception('Registry slot already occupied');
        }
        $this->_registry[$key] = $val;
    }

    public function get($key) {
        return $this->_registry[$key];
    }

    public function __get($key) {
        return $this->_registry[$key];
    }
}
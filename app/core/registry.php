<?php
/**
 *
 * @class Registry
 */

namespace core;


class Registry {
    private $_registry;

    public function set($key, $val) {
        $this->_registry[$key] = $val;
    }

    public function get($key) {
        return $this->_registry[$key];
    }
}
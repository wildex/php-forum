<?php
/**
 *
 * @class Registry
 */

namespace core;


class Registry {
    private $_registry = array();

    public function set($key, $val) {
        if(array_key_exists($key, $this->_registry)) {
            throw new \Exception(getRegistry()->get('translation')->translate('Registry slot already occupied'));
        }
        $this->_registry[$key] = $val;
    }

    public function get($key) {
        return $this->_registry[$key];
    }
}
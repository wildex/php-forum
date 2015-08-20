<?php
/**
 * @class \core\Data
 */

namespace core;


class Data {

    private $_data = array();

    public function set($key, $data) {
        $this->_data[$key] = $data;
    }

    public function get($key) {
        return $this->_data[$key];
    }

    public function getAll() {
        return $this->_data;
    }
}
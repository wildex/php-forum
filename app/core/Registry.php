<?php
/**
 *
 * @class Registry
 */

namespace core;


class Registry {
    private $_registry = [];

    /**
     * @param $key
     * @param $val
     * @throws \Exception
     */
    public function set($key, $val) {
        if(array_key_exists($key, $this->_registry)) {
            throw new \Exception('Registry slot already occupied');
        }
        $this->_registry[$key] = $val;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key) {
        return $this->_registry[$key];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key) {
        return $this->_registry[$key];
    }

    /**
     * Some function to load preset data
     *in Front controller and to be able to autocomplete
     */

    /**
     * Database entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getDBEntity() {
        return $this->DBEntity;
    }
}
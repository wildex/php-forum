<?php
/**
 * @class core\Mongodb
 */

namespace core;


class Mongodb extends DBDriver{

    public function __construct() {
        $params = getRegistry()->get('config')->get('database.mongo');
        $url =  sprintf(
            'mongodb://%s:%s@%s:%d/%s',
                $params['user'],
                $params['password'],
                $params['host'],
                $params['port'],
                $params['db']
        );
        $this->_connection =  new \MongoClient($url);
    }

    public function create($table, $params) {
        $params = $this->parseParams($params);
        $this->_connection->$table->insert($params['data']);
    }

    public function read($table, $params) {
        $params = $this->parseParams($params);
        $this->_connection->$table->find($params['where']);
    }

    public function update($table, $params) {
        $params = $this->parseParams($params);
        $this->_connection->$table->find($params['where']);
    }

    public function delete($table, $params) {
        $params = $this->parseParams($params);
        $this->_connection->$table->remove($params);
    }

    protected function parseParams($params) {
        return $params;
    }
}
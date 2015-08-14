<?php
/**
 * @class \core\db\Mongodb
 */

namespace core\db;

class MongoDBDriver extends DBDriver {

    public function __construct() {
        $params = R()->config->get('database.mongo');
        $url =  sprintf(
            'mongodb://%s:%s@%s:%d/%s',
                $params['user'],
                $params['password'],
                $params['host'],
                $params['port'],
                $params['auth_db']
        );
        $this->_connection =  (new \MongoClient($url))->selectDB($params['db']);
    }

    protected function create($table, $params) {
        $this->_connection->$table->insert($params['data']);
    }

    protected function read($table, $params) {
        $this->_connection->$table->find($params['where']);
    }

    protected function update($table, $params) {
        $this->_connection->$table->find($params['where']);
    }

    protected function delete($table, $params) {
        $this->_connection->$table->remove($params);
    }

    public function query($type, $table, $params) {
        return $params;
    }
}
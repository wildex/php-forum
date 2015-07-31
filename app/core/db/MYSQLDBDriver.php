<?php
/**
 * @class \core\db\PDODBDriver
 */

namespace core\db;


class MYSQLDBDriver extends DBDriver {
    protected function __construct() {
        $options = R()->config->get('database.sql');

        $dsn = sprintf(
            'mysql:dbname=%s;host=%s;port=%s',
            $options['db'],
            $options['host'],
            $options['port']
        );

        $this->_db = new \PDO($dsn, $options['user'], $options['password']);
    }

    public function create($table, $params) {}
    public function read($table, $params) {}
    public function update($table, $params) {}
    public function delete($table, $params) {}

    protected function parseParams($params) {
        return $params;
    }
}
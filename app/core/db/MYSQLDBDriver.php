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

    protected function create($table, $params) {

    }
    protected function read($table, $params) {
        $cols = (isset($params['cols']))? $params['cols']: '*';
        $query = sprintf('SELECT %s FROM %s', $cols, $table);
        if(isset($params['where'])) {
            $query .= sprintf(' WHERE %s', $params['where']['query']);
        }
    }
    protected function update($table, $params) {

    }
    protected function delete($table, $params) {

    }

    /**
     * @param $type
     * @param $table
     * @param $params
     */
    public function query($type, $table, $params) {
        /**
         * Parse where conditions
         * examples:
         * [
         *  'id > ?' => '12'
         *  'test > ?' => '14'
         * ];
         * 'id < 23'
         */
        if(array_key_exists('where', $params)) {
            $params['where']['values'] = array();
            if(is_array($params['where'])) {
                $params['where']['values'] = $params['where'];
                $params['where']['query'] = implode(' AND ', $params['where']);
            }
            else {
                $params['where']['query'] = $params['where'];
            }
        }
        /**
         * Parse cols
         */
        if(isset($params['cols']) && is_array($params['cols'])) {
            $params['cols'] = implode(',', $params['cols']);
        }
        call_user_func(array($this, $type), $table, $params);
    }
}
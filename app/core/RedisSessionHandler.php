<?php
/**
 * @class \core\RedisSessionHandler
 */

namespace core;


class RedisSessionHandler implements \SessionHandlerInterface {
    /**
     * Default session name
     */
    const DEFAULT_SESSION_NAME = 'PHPFORUMSID';

    /**
     * Session TTL, current value: 1 hour
     */
    const SESSION_TTL = 3600;

    /**
     * Session redis key prefix
     */
    const KEY_PREFIX = 'php-forum.session.key.';

    protected $redis_client;
    protected $prefix;

    public function __construct() {
        $redis_params = R()->config->get('redis');
        $redis = new \Redis();
        $redis->connect($redis_params['host'], $redis_params['port']);
        $this->redis_client = $redis;


        session_name(self::DEFAULT_SESSION_NAME);
    }

    public function open($savePath, $sessionName) {
        // No action necessary because connection is injected
        // in constructor and arguments are not applicable.
    }

    public function close() {
        $this->redis_client = null;
        unset($this->redis_client);
    }

    public function read($id) {
        $id = self::KEY_PREFIX . $id;
        $session_data = $this->redis_client->get($id);
        $this->redis_client->expire($id, self::SESSION_TTL);
        return $session_data;
    }

    public function write($id, $data) {
        $id = $this->prefix . $id;
        $this->redis_client->set($id, $data);
        $this->redis_client->expire($id, self::SESSION_TTL);
    }

    public function destroy($id) {
        $this->redis_client->del($this->prefix . $id);
    }

    public function gc($maxLifetime) {
        // no action necessary because using EXPIRE
    }
}
<?php
/**
 * @class \core\Config
 */

namespace core;


class Config {
    const FILE_NAME = 'config.json';

    private $_config = array();

    public function __construct() {
        $this->_config = json_decode(
            file_get_contents(CONFIG_DIR . self::FILE_NAME),
            true
        );
    }

    /**
     * Get config value, based on path.
     * Path should be in form
     * value.sub_value.prop
     *
     * @param $path
     * @return mixed
     */
    public function get($path) {
        $result = $this->_config;
        $slices = explode('.', $path);
        foreach($slices as $slice) {
            if(!is_null($result[$slice])) {
                $result = $result[$slice];
            }
        }
        return $result;
    }
}
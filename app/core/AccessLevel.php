<?php
/**
 * @class \core\AccessLevel
 */

namespace core;


class AccessLevel {
    const ACCESS_NONE   = 0;
    const ACCESS_VIEW   = 1;
    const ACCESS_EDIT   = 2;
    const ACCESS_CREATE = 4;
    const ACCESS_DELETE = 8;
    const ACCESS_ALL    = 32767;

    /**
     * @param $accessLevel
     * @param $accessLevelAvailable
     * @return boolean
     */
    public static function checkAccessLevel($accessLevel, $accessLevelAvailable = self::ACCESS_VIEW) {
        return boolval($accessLevel & $accessLevelAvailable);
    }
}
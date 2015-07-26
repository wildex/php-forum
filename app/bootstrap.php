<?php
/**
 * Load Registry and app config.
 */

/**
 * @return \core\Registry
 */
function getRegistry() {
    static $r;
    if(is_null($r)) {
        $r = new core\Registry();
    }
    return $r;
}
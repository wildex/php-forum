<?php

require '../config/const.php';
require ROOT_DIR . '/vendor/autoload.php';

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

/**
 * Shortcut for getRegistry()
 *
 * @return \core\Registry
 */
function R() {
    return getRegistry();
}

/**
 * App entry point
 * HERE WE GO
 * ...
 * AGAIN
 */
$fc = new core\FrontController();
if(!isset($argv)) {
    $fc->webRun();
}
else {
    $fc->cliRun();
}
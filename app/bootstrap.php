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
 * Add config to lazy load
 */

R()->set('config', new \core\Config());

/**
 * Set default timezone
 */

$timezone = R()->config->get('application.timezone');
date_default_timezone_set($timezone);

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
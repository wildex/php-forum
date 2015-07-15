<?php
try {
    require '../config/const.php';
    require ROOT_DIR . '/vendor/autoload.php';
    require ROOT_DIR . '/app/bootstrap.php';

    /**
     * App entry point
     * HERE WE GO
     * ...
     * AGAIN
     */
    $fc = new core\FrontController();
    $fc->run();
}
catch (Exception $e) {
    /**
     * AND HERE WE STOPPED GOING
     */
    echo sprintf('ALARM, SYSTEM ERROR: %s', $e->getMessage());
}
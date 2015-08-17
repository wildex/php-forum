<?php
try {
    require '../app/bootstrap.php';
}
catch (Exception $e) {
    /**
     * HERE SOMETHING WENT WRONG!!! :(
     */
    echo sprintf('ALARM, SYSTEM ERROR: %s', $e->getMessage());
}
<?php
/**
 * @class services\Forum
 */

namespace services;

use core\MYSQLDBDriver;
use core\Service;

class Forum extends Service {

    protected function create() {

    }

    protected function read() {

    }

    protected function update() {

    }

    protected function delete() {

    }

    protected function createModel() {
        return new \models\Forum(MYSQLDBDriver::getInstance());
    }
}
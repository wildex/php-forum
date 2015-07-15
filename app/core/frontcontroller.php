<?php
namespace core;

use Klein;

class FrontController {
    private $_router;

    public function __construct() {
        $this->_router = new Klein\Klein();
        $this->registerRoutes();
    }

    public function run() {
        $this->_router->dispatch();
    }

    private function registerRoutes() {
        $this->_router->respond('GET', '/', function () {
            return 'Hello World!';
        });
    }
}
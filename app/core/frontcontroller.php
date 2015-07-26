<?php
namespace core;

use services;
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
        $this->_router->respond('/[a:service]/[a:action]/', function ($request, $response) {
            $service = 'services\\' . $request->service;
            if(!class_exists($service)) {
                throw new \Exception(getRegistry()->get('translation')->translate('Cannot find service'));
            }
            $service = new $service();
            return $service->run($request->action);
        });
    }
}
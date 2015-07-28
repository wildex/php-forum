<?php
namespace core;

use services;
use Klein;

class FrontController {
    /**
     * @var Klein\Klein
     */
    private $_router;

    const ACTION_NAME_SEPARATOR = '-';

    public function __construct() {
        $this->_router = new Klein\Klein();
        $this->registerHelpers();
        $this->registerRoutes();
    }

    public function run() {
        $this->_router->dispatch();
    }

    private function registerRoutes() {
        $this->_router->respond('/[a:service]?/[*:action]?/[i:id]?/', function ($request, $response) {
            // Define default params
            $default_params = getRegistry()->get('config')->get('system.default_service');
            list($service, $action) = array_values($default_params);
            $service = $request->service ?: $service;
            $action = $request->action ?: $action;

            $service = 'services\\' . $service;
            if(!class_exists($service)) {
                throw new \Exception(getRegistry()->translation->translate('Cannot find service'));
            }
            $service = new $service($request, $response);
            return $service->run($this->transformActionName($action));
        });
    }

    private function registerHelpers() {
        getRegistry()->set('config', new Config());
        getRegistry()->set('translation', new Translation());
    }

    private function transformActionName($action) {
        $action = ucwords($action, self::ACTION_NAME_SEPARATOR);
        $action = str_replace(self::ACTION_NAME_SEPARATOR, '', $action);
        return lcfirst($action);
    }
}
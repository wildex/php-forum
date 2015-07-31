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
        $this->lazyLoad();
        $this->registerRoutes();
    }

    public function run() {
        $this->_router->dispatch();
    }

    private function registerRoutes() {
        $this->_router->respond('/[a:service]?/[*:action]?/[i:id]?/', function ($request, $response, $helper) {
            // Define default params
            $default_params = R()->get('config')->get('default_service');
            list($service, $action) = array_values($default_params);
            $service = $request->service ?: $service;
            $action = $request->action ?: $action;

            $service = 'services\\' . $service;
            if(!class_exists($service)) {
                throw new \Exception(R()->translation->translate('Cannot find service'));
            }
            $service = new $service($request, $response, $helper);
            return $service->run($this->transformActionName($action));
        });
    }

    private function lazyLoad() {
        R()->set('config', new Config());
        R()->set('translation', new Translation());
        R()->set('user', new AuthUser());
    }

    private function transformActionName($action) {
        $action = ucwords($action, self::ACTION_NAME_SEPARATOR);
        $action = str_replace(self::ACTION_NAME_SEPARATOR, '', $action);
        return lcfirst($action);
    }
}
<?php
namespace core;

use services;
use Klein;

use \Symfony\Component\Console,
    \Doctrine\ORM\Tools\Console as DoctrineConsole,
    \Doctrine\ORM\Tools\Setup,
    \Doctrine\ORM\EntityManager;

class FrontController {
    /**
     * @var Klein\Klein
     */
    private $_router;

    const ACTION_NAME_SEPARATOR = '-';

    public function __construct() {
        $this->lazyLoad();
    }

    public function webRun() {
        $this->lazyLoadWeb();
        $this->_router = new Klein\Klein();
        $this->registerRoutes();
        $this->_router->dispatch();
    }


    public function cliRun() {
        $app_config = R()->config->get('application');
        $application = new Console\Application($app_config['name'], $app_config['version']);

        $helperSet = DoctrineConsole\ConsoleRunner::createHelperSet(R()->getDBEntity());
        $application->setHelperSet($helperSet);
        DoctrineConsole\ConsoleRunner::addCommands($application);

        $application->run();
    }

    private function registerRoutes() {
        $this->_router->respond(['GET', 'POST'], '/[a:service]?/[*:action]?/[i:id]?/', function ($request, $response, $helper) {
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

    /**
     * Lazy load for basic functionality
     *
     * @throws \Exception
     */
    private function lazyLoad() {
        R()->set('translation', new Translation());
        R()->set('DBEntity', $this->createDBEntityManager());
    }

    /**
     * Additional lazy load, only for web part of
     * application.
     */
    private function lazyLoadWeb() {
        R()->set('user', new AuthUser());
    }

    /**
     * Factory method to create Doctrine entity manager
     *
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    private function createDBEntityManager() {
        $config = Setup::createAnnotationMetadataConfiguration(array(ENTITIES_DIR), IS_DEBUG_ENABLED);
        return EntityManager::create(R()->config->get('database'), $config);
    }

    /**
     * Transform action name to camelCase (begins from small letter).
     * And replace ACTION_NAME_SEPARATOR with empty string (remove it).
     *
     * @param $action
     * @return string
     */
    private function transformActionName($action) {
        $action = ucwords($action, self::ACTION_NAME_SEPARATOR);
        $action = str_replace(self::ACTION_NAME_SEPARATOR, '', $action);
        return lcfirst($action);
    }
}
<?php
/**
 * @class services\Service
 */

namespace core;

use \klein\Response, \klein\Request, \klein\ServiceProvider as Helper;

abstract class Service {

    protected $_view;
    protected $_helper;
    protected $_data;
    protected $_config;

    protected $_response;
    protected $_request;

    const SERVICE_CONFIG_EXT = '.php';

    public function __construct(Request $request, Response $response, Helper $helper) {
        $this->_request     = $request;
        $this->_response    = $response;
        $this->_view        = new View();
        $this->_helper      = $helper;
        $this->_data        = new Data();
        $this->_config      = $this->loadConfig();
    }

    /**
     * Return html page, or just json data.
     *
     * @param $action string action name (class method to call)
     * @throws \core\exception\SystemException
     */
    public function run($action = null) {

        if(!method_exists($this, $action)) {
            throw new exception\SystemException(R()->translation->translate('Not found.'),
                                                    exception\SystemException::ERR_404);
        }

        $this->checkAccess($action);

        $this->setCommonData($this->createCommonData($action));

        $this->_view->setTemplate(
            strtolower(str_replace('\\', DIRECTORY_SEPARATOR, static::class) . DIRECTORY_SEPARATOR . $action . '.' . View::TPL_FILE_EXTENSION)
        );

        call_user_func(array($this, $action));

        // @TODO: Check if JSON data requested
        // return html
        echo $this->_view->render(['data' => $this->_data->getAll()]);
        // return json data
        // echo json_encode($this->_data);
    }

    protected function loadConfig() {
        $config = array();

        $config_path = CONFIG_DIR
                        . str_replace('\\', DIRECTORY_SEPARATOR, strtolower(static::class))
                        . self::SERVICE_CONFIG_EXT;

        if(file_exists($config_path)) {
            $config = require $config_path;
        }

        return $config;
    }

    protected function checkAccess($action) {

        $user_rights = R()->getUser()->getRights();

        $access_level = AccessLevel::ACCESS_READ;

        if(!empty($this->_config)
            && isset($this->_config['access'][$action])) {
            $access_level = $this->_config['access'][$action];
        }

        if($user_rights < $access_level) {
            throw new exception\SystemException(R()->translation->translate('Access restricted.'),
                exception\SystemException::ERR_403);
        }
    }

    protected function createCommonData($action) {
        return [
            'page_properties' => [
                'title' => R()->translation->translate($action),
                'action' => strtolower(static::class) . '/' . $action . '/'
            ]
        ];
    }

    protected function setCommonData($data) {
        $this->_data->set('common', $data);
    }

    abstract protected function create();

    abstract protected function read();

    abstract protected function update();

    abstract protected function delete();

}
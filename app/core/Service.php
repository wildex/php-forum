<?php
/**
 * @class services\Service
 */

namespace core;

use models;

use \klein\Response, \klein\Request, \klein\ServiceProvider as Helper;

abstract class Service {

    protected $_model;
    protected $_view;
    protected $_helper;
    protected $_data = array();

    protected $_response;
    protected $_request;

    public function __construct(Request $request, Response $response, Helper $helper) {
        $this->_request     = $request;
        $this->_response    = $response;
        $this->_view        = new View();
        $this->_model       = $this->createModel();
        $this->_helper      = $helper;
    }

    /**
     * Return html page, or just json data.
     *
     * @param $action string action name (class method to call)
     * @throws \core\exception\SystemException
     */
    public function run($action = null) {

        if(!method_exists($this, $action)) {
            throw new exception\SystemException(R()->translation->translate('Not found.'), exception\SystemException::ERR_404);
        }

        $this->_view->setTemplate(
            strtolower(str_replace('\\', '/', static::class) . DIRECTORY_SEPARATOR . $action . '.' . View::TPL_FILE_EXTENSION)
        );

        call_user_func(array($this, $action));

        // return html
        echo $this->_view->render($this->_data);
        // return json data
        // echo json_encode($this->_data);
    }

    abstract protected function create();

    abstract protected function read();

    abstract protected function update();

    abstract protected function delete();

    abstract protected function createModel();
}
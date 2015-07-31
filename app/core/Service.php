<?php
/**
 * @class services\Service
 */

namespace core;

use models;

use \klein\Response, \klein\Request;

abstract class Service {

    protected $_model;
    protected $_view;
    protected $_data = array();

    protected $_response;
    protected $_request;

    public function __construct(Request $request, Response $response) {
        $this->_request     = $request;
        $this->_response    = $response;
        $this->_view        = new View();
        $this->_model       = $this->createModel();
    }

    /**
     * Return html page, or just json data.
     *
     * @param $action string action name (class method to call)
     * @throws \core\SystemException
     */
    public function run($action = null) {

        if(!method_exists($this, $action)) {
            throw new SystemException(getRegistry()->translation->translate('Not found.'), SystemException::ERR_404);
        }

        $this->_view->setTemplate(
            strtolower(__CLASS__ . DIRECTORY_SEPARATOR . $action . '.' . View::TPL_FILE_EXTENSION)
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
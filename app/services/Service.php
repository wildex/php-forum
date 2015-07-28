<?php
/**
 * @class services\Service
 */

namespace services;

use core;

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
        $this->_view        = new core\View();
        $this->_model       = new models\Model(new core\Mongodb());
    }

    /**
     * Return html page, or just json data.
     *
     * @param $action string action name (class method to call)
     * @throws \core\SystemException
     */
    public function run($action = null) {

        if(!method_exists($this, $action)) {
            throw new core\SystemException(getRegistry()->translation->translate('Not found.'), core\SystemException::ERR_404);
        }

        $this->_view->setTemplate(
            strtolower(__CLASS__ . DIRECTORY_SEPARATOR . $action . '.' . core\View::TPL_FILE_EXTENSION)
        );

        call_user_func(array($this, $action));

        // return html
        echo $this->_view->render($this->_data);
        // return json data
        // echo json_encode($this->_data);
    }

    protected function create() {

    }

    protected function read() {

    }

    protected function update() {

    }

    protected function delete() {

    }
}
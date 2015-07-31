<?php
/**
 * @class services\User
 */

namespace services;

use core\db\MYSQLDBDriver;
use core\Service;

class User extends Service {
    protected function create() {

    }

    protected function read() {

    }

    protected function update() {

    }

    protected function delete() {

    }

    protected function login() {
        $this->_helper->validateParam('name', R()->translation->translate('Bad username'))->isAlpha();
        $this->_helper->validateParam('password', R()->translation->translate('Bad password'))->isAlpha();
        R()->user->login($this->_request->paramsGet()->name, $this->_request->paramsGet()->password);
    }

    protected function createModel() {
        return new \models\User(MYSQLDBDriver::getInstance());
    }
}
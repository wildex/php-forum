<?php
/**
 * @class services\User
 */

namespace services;

use core\exception\LogicException;
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

    }

    protected function register() {
        $email = $this->_request->param('title');

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \core\exception\LogicException(R()->translation->translate('TXT_BAD_EMAIL_FORMAT'));
        }
        if(!$this->isEmailAvailable($email)) {
            throw new \core\exception\LogicException(R()->translation->translate('TXT_EMAIL_IS_ALREADY_TAKEN'));
        }
    }

    private function isEmailAvailable($email) {
        $dql = 'SELECT 1 FROM \entity\User user WHERE user.email = :email';

        $query = R()->getDBEntity()->createQuery($dql);
        $query->setParameter('email', $email);

        $res = $query->getResult();
        return empty($res);
    }
}
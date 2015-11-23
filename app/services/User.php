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
        $honey_name = $this->_request->param('honey_name');
        $honey_name_second = $this->_request->param('honey_name_second');
        $email = $this->_request->param('email');
        $password = $this->_request->param('password');

        if(!empty($email)) {
            /**
             * honey pot bot protection
             * $honey_name should be not filled
             * $honey_name_second should be filled with something
             */
            if(!empty($honey_name) || empty($honey_name_second)) {
                throw new \core\exception\LogicException(R()->translation->translate('TXT_YOU_ARE_BOT'));
            }

            $this->_helper->validate($email, R()->translation->translate('TXT_BAD_EMAIL_FORMAT'))->isEmail();

            if(!$this->isEmailAvailable($email)) {
                throw new \core\exception\LogicException(R()->translation->translate('TXT_EMAIL_IS_ALREADY_TAKEN'));
            }

            $user = new \entity\User();
            R()->getDBEntity()->persist($user);
            R()->getDBEntity()->flush();
        }
    }

    private function isEmailAvailable($email) {
        $dql = 'SELECT 1 FROM \entity\User user WHERE user.user_email = :email';

        $query = R()->getDBEntity()->createQuery($dql);
        $query->setParameter('email', $email);

        $res = $query->getResult();

        return empty($res);
    }
}
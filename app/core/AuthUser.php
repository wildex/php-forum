<?php
/**
 * @class \core\AuthUser
 */

namespace core;

class AuthUser {
    private $_user_data;

    public function __construct() {
        session_set_save_handler(new RedisSessionHandler());
        session_start();

        $this->loadUserData();
    }

    private function loadUserData() {
        if(isset($_SESSION['uid'])) {
            $this->_user_data = R()->getDBEntity()->find('User', (int)$_SESSION['uid']);
        }
    }

    public function login($user_email, $password) {
        $user_data = R()->getDBEntity()->getRepository('User')->findOneBy(array('user_email' => $user_email));

        if(!empty($user_data) && password_verify($password, $user_data['password'])) {
            // just in case removing password from user data array
            unset($user_data['password']);

            $this->_user_data = $user_data;
            $_SESSION['uid'] = (int)$user_data['id'];
        }
    }

    public function logout() {
        session_destroy();
    }

    public function getRights() {
        return AccessLevel::ACCESS_READ;
    }
}
<?php
/**
 * @class \core\AuthUser
 */

namespace core;

class AuthUser {
    private $_user_model;

    private $_user_data;

    public function __construct() {
        session_set_save_handler(new RedisSessionHandler());
        session_start();

        $this->_user_model = new \models\User(MYSQLDBDriver::getInstance());
    }

    public function login($user_name, $password) {
        $user_data = $this->_user_model->read(
            [ 'where' => [ 'user_name' => $user_name ] ]
        );

        if(password_verify($password, $user_data['password'])) {
            // just in case removing password from user data array
            unset($user_data['password']);

            $this->_user_data = $user_data;
            $_SESSION['uid'] = $user_data['id'];
        }
    }

    public function logout() {
        session_destroy();
    }
}
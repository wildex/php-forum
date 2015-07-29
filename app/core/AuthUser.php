<?php
/**
 * @class \core\AuthUser
 */

namespace core;

use models\User;

class AuthUser {
    private $_user_model;

    private $_user_data;

    public function __construct(User $user_model) {
        session_set_save_handler(new RedisSessionHandler());
        session_start();

        $this->_user_model = $user_model;
    }

    public function login($user_name, $password) {
        $user_data = $this->_user_model->read(
            [
                'where' => ['user_name' => $user_name]
            ]
        );

        if(password_verify($password, $user_data['password'])) {
            $_SESSION['uid'] = $user_data['id'];
        }
    }

    public function logout() {
        session_destroy();
    }
}
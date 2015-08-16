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

        //$this->_user_model = new \models\User(db\MYSQLDBDriver::getInstance());
        $this->loadUserData();
    }

    private function loadUserData() {
        if(isset($_SESSION['uid'])) {
            /*$this->_user_data = $this->_user_model->read(
                [ 'where' => [ 'user_id' => (int)$_SESSION['uid'] ] ]
            );*/
        }
    }

    public function login($user_name, $password) {
        /*$user_data = $this->_user_model->read(
            [ 'where' => [ 'user_name' => $user_name ] ]
        );*/

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
}
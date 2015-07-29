<?php
/**
 * @class \models\User
 */

namespace models;

use core\Model;

class User extends Model {
    protected $_table = 'system_user';

    public function getPassword($user_name) {
        return $user_name;
    }

    public function read($params) {
        return [];
    }
}
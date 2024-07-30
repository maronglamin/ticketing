<?php

namespace http\model\User;

use core\Session;
use http\model\Model;

class Users
{
    public static function getUser($id)
    {
        return Model::get()
            ->query("SELECT * FROM users WHERE id = :id", [
                'id' => $id
            ])->findOrFail();
    }

    public static function currentUser()
    {
        $username = Session::user();
        return Model::get()
            ->query("SELECT * FROM users WHERE username = :username", [
                'username' => $username
            ])->find();
    }

    public static function hasRole($role)
    {
        $user = static::currentUser();
        if ($user["user_role"] ===  $role || $user["user_role"] === 'Administrator') {
            return true;
        }
        return false;
    }

    public static function hasDepartment($department)
    {
        $user = static::currentUser();
        if ($user["department"] ===  $department || $user["department"] === 'IT') {
            return true;
        }
        return false;
    }
    
}

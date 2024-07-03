<?php

namespace core;

use core\App;
use core\Session;
use core\Database;
use core\Response;

class Authenticator 
{
    public static function attempt($username, $password)
    {
        $user = static::user($username);
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                static::login([
                    'username' => $username,
                ]);
        
                return true;
            }
        }
        return false;
    }

    public static function create($username, $password) 
    {
        $user = static::createuser($username);

        if (! $user) {
                static::get()->insert('users', [
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'checker' => 'System',
                    'checker_at' => cur_time(),
                    'maker' => 'System',
                    'make_at' => cur_time()
                ]);
                
            return true;
        }

        return false;
    }

    public static function user($username)
    {
        return static::get()
            ->query('select * from users where username = :username', [
                'username' => $username
            ])->find();

    }

    public static function createuser($user)
    {
        return static::get()
                ->query('select * from users where username = :username', [
                    'username' => $user
                ])->find();

    }

    public static function restrictions($obj, $username)
    {
        $user = static::user($username);

        if ($user['user_status'] === Response::STATUS_ENABLED) {
            if ($user['confirmed'] !== Response::AUTHORISD) {
                $obj->error('username', 'User unauthorized')->throw();
            }
        }

        if ($user['user_status'] === Response::STATUS_HOLD) {
            $obj->error('username', 'User is on hold, please try later')->throw();  
        }

        if ($user['user_status'] === Response::STATUS_DISABLED) {
            $obj->error('username', 'User is disabled')->throw();  
        }

        if ($user['user_status'] === Response::STATUS_LOCKED) {
            $obj->error('username', 'Account is locked')->throw();  
        }
        if ($user['user_status'] === Response::STATUS_NEW_USER) {
            $obj->error('username', 'Account newly created, wait for administrator for authorization')->throw();  
        } 

    }


    public static function findById($table, $id)
    {
        return static::get()->findById($table, $id);
    }

    public static function save($table, array $attributes)
    {
        return static::get()->insert($table, $attributes);
    }

    public static function commit($table, $id, array $attributes)
    {
        return static::get()->update($table, $id, $attributes);
    }

    public static function customCommit($table, $custom_id, $id, array $attributes)
    {
        return static::get()->customUpdate($table, $custom_id, $id, $attributes);
    }

    public static function doubleFieldUpdate($table, $custom_id, $id, $customField, $customValue, array $attributes)
    {
        return static::get()->doubleFieldUpdate($table, $custom_id, $id, $customField, $customValue, $attributes);
    }

    public static function drop($table, $id)
    {
        return static::get()->delete($table, $id);
    }

    public static function get()
    {
        return App::resolve(Database::class);
    }

    public static function login($user)
    {
        Session::create($user);
        
    }

    public static function logout() 
    {
        Session::destroy();
    }
}
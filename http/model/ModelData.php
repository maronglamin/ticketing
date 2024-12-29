<?php

namespace http\model;

use core\Session;
use core\Response;
use core\Authenticator;
use FontLib\Table\Type\name;

class ModelData 
{
    public static function get($table, $user, $start, $order = 'id')
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' AND maker_id = '{$user}' order by $order desc limit $start," . Response::PAGE_RECORD)
                ->get();
    }

    public static function getall($table, $start, $order = 'id')
    {
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' order by $order desc limit $start," . Response::PAGE_RECORD)
                ->get();
    }

    public static function AssignExist($table, $id)
    {
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' and id = '{$id}' and ticket_assigned_to != ''")
                ->find();
    }

    public static function getLastID($table)
    {
        return Authenticator::get()
                ->query("SELECT max(id) as ticket_id FROM {$table}")
                ->get();
    }

    public static function getLastInsertedID($table)
    {
        return Authenticator::get()
                ->query("SELECT max(id) as ticket_id FROM {$table}")
                ->find();
    }

    public static function userEmail()
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM users WHERE soft_deleted = 'NTDEL' AND username = '{$user}'")
                ->find();
    }

    public static function addUserEmail()
    {
        $email = static::userEmail();
        return $email['email'];
    }

    public static function userACL()
    {
        return Authenticator::get()
        ->query("SELECT `name`, auto_auth, username FROM users WHERE soft_deleted = :soft_deleted AND username = :username", [
            'soft_deleted' => 'NTDEL',
            'username' => Session::user()

        ])->find();
    }




}
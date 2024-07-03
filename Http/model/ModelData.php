<?php

namespace Http\model;

use core\Session;
use core\Response;
use core\Authenticator;

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
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' order by $order desc limit $start," . Response::PAGE_RECORD)
                ->get();
    }

    public static function getLastID($table)
    {
        return Authenticator::get()
                ->query("SELECT max(id) as ticket_id FROM {$table}")
                ->get();
    }

    public static function userEmail()
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM users WHERE soft_deleted = 'NTDEL' AND username = '{$user}'")
                ->find();
    }

    public static function emailAdd()
    {
        $email = static::userEmail();
        return $email['email'];
    }


}
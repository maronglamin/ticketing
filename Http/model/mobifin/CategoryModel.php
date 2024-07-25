<?php

namespace http\model\mobifin;

use core\Session;
use core\Response;
use core\Authenticator;

class CategoryModel 
{
    public static function getParent($table)
    {
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' and parent = '0'")
                ->get();
    }

    public static function findParent()
    {
        return Authenticator::get()
                ->query("SELECT * FROM mpr_catergories WHERE soft_deleted = 'NTDEL' and parent = '0'")
                ->get();
    }

    public static function child()
    {
        return Authenticator::get()
                ->query("SELECT * FROM mpr_catergories WHERE soft_deleted = 'NTDEL' and parent != '0'")
                ->get();
    }


    public static function getChild($table, $parentid)
    {
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' and parent = $parentid")
                ->get();
    }
}
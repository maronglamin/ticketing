<?php

namespace http\model;

use core\Authenticator;

class DepartmentModel 
{
    public static function getEmail($email)
    {
        return Authenticator::get()
                ->query("SELECT * FROM aps_department WHERE soft_deleted = :soft_deleted AND email = :email", [
                    'soft_deleted' => 'NTDEL',
                    'email' => $email
                ])
                ->get();
    }

    public static function getDepartment()
    {
        return Authenticator::get()
                ->query("SELECT * FROM aps_department WHERE soft_deleted = :soft_deleted", [
                    'soft_deleted' => 'NTDEL',
                ])
                ->get();
    }
}

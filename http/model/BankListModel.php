<?php

namespace http\model;

use core\Authenticator;

class BankListModel 
{
    public static function getBankList()
    {
        return Authenticator::get()
            ->query("SELECT * FROM instructed_banks WHERE soft_deleted = :soft_deleted", [
                'soft_deleted' => 'NTDEL'
            ])
            ->get();
    }
}
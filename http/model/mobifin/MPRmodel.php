<?php

namespace http\model\mobifin;

use core\Session;
use core\Response;
use core\Authenticator;

class MPRmodel
{
    public static function getMPR($table, $start, $order = 'id')
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' AND maker_id = '{$user}' and ticket_channel = 'MPR' order by $order desc limit $start," . Response::PAGE_RECORD)
                ->get();
    }

    public static function getLITS($table, $department, $start, $order = 'id')
    {
        $user_department = Session::department();
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' AND department = '{$department}'
                         OR user_department = '{$user_department}' ORDER BY $order DESC LIMIT $start," . Response::PAGE_RECORD)
                ->get();
    }
}

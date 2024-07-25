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

    public static function getLITS($table, $user, $start, $order = 'id')
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' AND maker_id = '{$user}' and ticket_channel = 'LOCAL_IT_SUPPORT' order by $order desc limit $start," . Response::PAGE_RECORD)
                ->get();
    }
}
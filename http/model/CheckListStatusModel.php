<?php

namespace http\model;

use core\Authenticator;

class CheckListStatusModel 
{
    public static function getTickets($ticketStatus)
    {
        return Authenticator::get()
                ->query("SELECT * FROM aps_ticketing WHERE soft_deleted = 'NTDEL' AND `status` = '{$ticketStatus}'")
                ->get();
    }
}

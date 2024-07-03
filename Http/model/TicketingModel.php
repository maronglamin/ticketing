<?php

namespace Http\model;

use core\Session;
use core\Response;
use core\Authenticator;

class TicketingModel 
{
    public static function getTicket($user, $ticket_id)
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM aps_ticketing WHERE soft_deleted = 'NTDEL' AND maker_id = '{$user}' AND ticketId = '{$ticket_id}'")
                ->get();
    }

    public static function getTicketId($ticket_id)
    {
        $user = Session::user();
        return Authenticator::get()
                ->query("SELECT * FROM aps_ticketing WHERE ticketId = '{$ticket_id}'")
                ->find();
    }

    public static function getAllTicket($ticket_id)
    {
        return Authenticator::get()
                ->query("SELECT * FROM aps_ticketing WHERE soft_deleted = 'NTDEL' AND id = '{$ticket_id}'")
                ->get();
    }

    public static function paginateTicket($table, $start, $order = 'id')
    {
        return  Authenticator::get()
                ->query ("SELECT * FROM $table WHERE soft_deleted = 'NTDEL' order by $order desc limit $start," . Response::PAGE_RECORD)
                ->get();
    }

}

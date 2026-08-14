<?php

namespace http\model\BiReports;

use core\Session;
use core\Authenticator;

class TicketingFilterModel
{
    public static function getFilters($status, $priority, $ticketId)
    {
       
         return Authenticator::get()
            ->query("SELECT 
                        ticketId,
                        department,
                        summary,
                        priority,
                        make_at AS Update_at,
                        `status`  
                    FROM 
                        aps_ticketing
                    WHERE (
                            user_department = :user_department 
                        OR  department = :department
                        )
                    AND soft_deleted = :soft_deleted
                    AND (
                            `status` = :status
                        OR  priority = :priority
                        OR  ticketId = :ticketId
                        )
                    ORDER BY make_at
                    DESC
                    LIMIT 20", [
                        'soft_deleted' => 'NTDEL',
                        'status' => $status,
                        'priority' => $priority,
                        'ticketId' => $ticketId,
                        'user_department' => Session::department(),
                        'department' => Session::department(),
                    ])->get();
    }

    public static function getAllFilters($status, $priority, $ticketId)
    {
       
         return Authenticator::get()
            ->query("SELECT 
                        ticketId AS Request_id,
                        department,
                        summary,
                        priority,
                        make_at AS Update_at,
                        `status`
                    FROM 
                        aps_ticketing
                    WHERE (
                            user_department = :user_department 
                        OR  department = :department
                        )
                    AND soft_deleted = :soft_deleted
                    AND (
                            `status` = :status
                        OR  priority = :priority
                        OR  ticketId = :ticketId
                        )
                    ORDER BY make_at
                    DESC", [
                        'soft_deleted' => 'NTDEL',
                        'status' => $status,
                        'priority' => $priority,
                        'ticketId' => $ticketId,
                        'user_department' => Session::department(),
                        'department' => Session::department(),
                    ])->get();
    }
}
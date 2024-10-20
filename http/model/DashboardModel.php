<?php

namespace http\model;

use core\Authenticator;

class DashboardModel 
{
    public static function getDeptTicketCount($deptName)
    {
        return Authenticator::get()
        ->query("SELECT COUNT(department) as ticketCount FROM aps_ticketing WHERE department = :department", [
            'department' => $deptName,
        ])
        ->find();
    }
    
    public static function getUserTicketCount($username, $deleted)
    {
        return Authenticator::get()
        ->query("SELECT COUNT(`maker_id`) as username FROM aps_ticketing WHERE maker_id = :maker_id and soft_deleted = :soft_deleted", [
            'maker_id' => $username,
            'soft_deleted' => $deleted
        ])
        ->find();
    }

    public static function getTicketStatusCount($deptName, $status)
    {
        return Authenticator::get()
        ->query("SELECT COUNT(department) as ticketStatus FROM aps_ticketing WHERE department = :department and `status` = :status", [
            'department' => $deptName,
            'status' => $status
        ])
        ->find();
    }
    
}
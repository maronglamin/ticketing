<?php

namespace http\model;

use core\Session;
use core\Response;
use core\Authenticator;

class ClockinsModel 
{
    public static function getClockin($user)
    {
        $currentDate = month_year();
        return Authenticator::get()
        ->query("SELECT * FROM smart_hr_clock_ins WHERE username = '{$user}' AND month_year = '{$currentDate}' AND soft_deleted = 'NTDEL' ORDER BY id desc")
        ->find();
    }

    public static function getPreviousClockin($user)
    {
        $previousDate = previousDate();
        return Authenticator::get()
        ->query("SELECT * FROM smart_hr_clock_ins WHERE username = '{$user}' AND month_year = '{$previousDate}' AND soft_deleted = 'NTDEL' ORDER BY id desc")
        ->find();
    }

    public static function getList()
    {
        $currentDate = month_year();
        return Authenticator::get()
        ->query("SELECT * FROM smart_hr_clock_ins WHERE month_year = '{$currentDate}' AND soft_deleted = 'NTDEL' ORDER BY id desc")
        ->get();
    }

    public static function getPreviousList()
    {
        $previousDate = previousDate();
        return Authenticator::get()
        ->query("SELECT * FROM smart_hr_clock_ins WHERE month_year = '{$previousDate}' AND soft_deleted = 'NTDEL' ORDER BY id desc")
        ->get();
    }

    public static function getListByDate($date)
    {
        return Authenticator::get()
        ->query("SELECT * FROM smart_hr_clock_ins WHERE month_year = '{$date}' AND soft_deleted = 'NTDEL' ORDER BY id desc")
        ->get();
    }

    public static function getByDateClockin($date, $user)
    {
        return Authenticator::get()
        ->query("SELECT * FROM smart_hr_clock_ins WHERE username = '{$user}' AND month_year = '{$date}' AND soft_deleted = 'NTDEL' ORDER BY id desc")
        ->find();
    }
    
}
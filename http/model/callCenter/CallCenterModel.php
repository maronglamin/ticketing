<?php

namespace http\model\callCenter;

use core\Session;
use core\Response;
use core\Authenticator;

class CallCenterModel 
{
    public static function getCategory($category)
    {
        return Authenticator::get()
            ->query("SELECT * FROM aps_call_canter_category WHERE `soft_deleted` = :soft_deleted AND `category_label` = :category_label", [
                'soft_deleted' => 'NTDEL',
                'category_label' => $category
            ])->get();
    }

    public static function getCallTickets($table, $start, $order = 'id')
    {
        $user = Session::user();
        return Authenticator::get()
        ->query("SELECT * FROM {$table} WHERE soft_deleted = 'NTDEL' AND maker_id = '{$user}' order by $order desc limit $start," . Response::PAGE_RECORD)
        ->get();
    }

    public static function getCallCategory($category)
    {
        return Authenticator::get()
            ->query("SELECT count(*) as count FROM aps_call_center WHERE `soft_deleted` = :soft_deleted AND `maker_id` = :maker_id AND `reasonForCall` = :reasonForCall",[
                'soft_deleted' => 'NTDEL',
                'maker_id' => Session::user(),
                'reasonForCall' => $category
            ])->find();
    }

    public static function getCallPaginator()
    {
        return Authenticator::get()
            ->query("SELECT count(*) FROM aps_call_center WHERE `soft_deleted` = :soft_deleted AND `maker_id` = :maker_id",[
                'soft_deleted' => 'NTDEL',
                'maker_id' => Session::user()
            ])->find();
    }


}
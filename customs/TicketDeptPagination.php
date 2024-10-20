<?php 

namespace customs;

use core\Session;
use core\Response;
use core\Authenticator;

class TicketDeptPagination {
    
    public static function paginate() {

        $query = static::pagination();    
        $records = $query['count(*)'];
        return $records;
    }

    public static function page()
    {
        return isset($_GET['page']) ? $_GET['page'] : Response::DEFAULT_PAGE;
    }

    public static function pages()
    {
        return ceil(static::paginate() / Response::PAGE_RECORD);
    }

    public static function start()
    {
        return (static::page() - 1) * Response::PAGE_RECORD;
    }

    public static function pagination()
    {
        $department = Session::department();
        return Authenticator::get()
                ->query("SELECT count(*) from aps_ticketing where soft_deleted = :soft_deleted AND department = :department ORDER BY id",[
                    'soft_deleted' => 'NTDEL',
                    'department' => $department
                ])
                ->find();
    }
    
}

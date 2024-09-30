<?php 

namespace core;

use core\Response;
use core\Authenticator;

class Paginator {
    
    public static function paginate($table, $order = 'id') {

        $query = static::pagination($table, $order);    
        $records = $query['count(*)'];
        return $records;
    }

    public static function page()
    {
        return isset($_GET['page']) ? $_GET['page'] : Response::DEFAULT_PAGE;
    }

    public static function pages($table)
    {
        return ceil(static::paginate($table) / Response::PAGE_RECORD);
    }

    public static function start()
    {
        return (static::page() - 1) * Response::PAGE_RECORD;
    }

    public static function pagination($table, $order = 'id', $optionalCol = '', $optionalField = '')
    {
        $department = Session::department();
        return Authenticator::get()
                ->query("SELECT count(*) from $table where soft_deleted = 'NTDEL' ORDER BY $order")
                ->find();
    }

}

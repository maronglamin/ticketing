<?php

namespace Http\controller;

use core\App;
use core\Database;
use core\Paginator;
use core\Authenticator;

class Controller 
{
    protected $controller, $action;

    public function __construct($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    public static function get()
    {
        return App::resolve(\core\Database::class);
    }

    public static function paginates($table, $ordered)
    {
        $data = Authenticator::get()->query("SELECT * FROM {$table} where soft_deleted = 'NTDEL' ORDER BY {$ordered} DESC")->find();

        if (count($data) > 0) {
            while ($data) {
                return Paginator::paginate($data, 1);
            }
        }

    }
}
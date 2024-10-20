<?php

namespace http\model;


use core\Response;
use http\model\Model;

class RequestTypeModel {

    public static function getParent() {
        return Model::get()
        ->query("SELECT * FROM mpr_catergories WHERE parent = :parent", [
            'parent' => Response::PARENT_ID
        ])->get();
    }

    public static function getChild() {
        return Model::get()
        ->query("SELECT * FROM mpr_catergories WHERE parent != :parent", [
            'parent' => Response::PARENT_ID
        ])->get();
    }
}

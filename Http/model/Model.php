<?php

namespace Http\model;

use core\App;
use core\Database;
use core\Response;

class Model 
{
    public static function pagination($table, $oder = 'id')
    {
        return static::get()
            ->query("SELECT count(*) from $table where soft_deleted = 'NTDEL' ORDER BY $oder desc")
            ->find();
    }

    public static function data($table, $start, $order = 'id')
    {
        return static::get()
            ->query ("SELECT * from $table where soft_deleted = 'NTDEL' order by $order desc limit $start," . Response::PAGE_RECORD)
            ->get();
    }

    public static function get()
    {
        return App::resolve(Database::class);
    }

    public static function edit($table, $id)
    {
        return static::get()
            ->query("select * from $table where id = :id", ['id' => $id])
            ->find();
    }

    public static function fetch($table, $value)
    {
        return static::get()
            ->query("select * from $table where class_id = :class_id", ['class_id' => $value])
            ->get();
    }

    public static function terms()
    {
        return static::get()
            ->query("select * from acad_terms where term_status = :term_status and soft_deleted = :soft_deleted and confirmed = :confirmed", [
                'term_status' => 'STCHOP',
                'soft_deleted' => 'NTDEL',
                'confirmed' => 'CONF'
                ])
            ->get();
    }

    public static function studExist($scode, $cid, $stid, $term)
    {
        return static::get()
            ->query("select * from scores where subj_code =:subj_code and class_id =:class_id and term_id =:term_id and student_id =:student_id", [
                'subj_code' => $scode,
                'class_id' => $cid,
                'student_id' => $stid,
                'term_id' => $term
            ])
            ->find();
    }

    public static function scoresExist($scode, $cid, $stid, $term)
    {
        return static::studExist($scode, $cid, $stid, $term)?? false;
    }
}
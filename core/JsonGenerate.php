<?php

namespace core;

use http\model\Model;

class JsonGenerate 
{
    public static function encodeText($data)
    {
        return json_encode($data);
    }

    public static function decodeText($data)
    {
        return json_decode($data, true);
    }

    public static function getEncodeText($id, $decodeCol = '')
    {
        $encodedCol = Model::get()
            ->query("SELECT * FROM aps_ticketing WHERE id = :id", [
                'id' => $id
            ])->find();
            
        return static::decodeText($encodedCol[$decodeCol]);
    }

    public static function addComment($jsonData, $baseKey, $newComment) {
        $index = 1;
        while (array_key_exists($baseKey . "_" . $index, $jsonData)) {
            $index++;
        }
        return $jsonData[$baseKey . "_" . $index] = $newComment;
    }
}

<?php

namespace core;

class Http 
{
    public static function is_request($key)
    {
        return dnd(($_SERVER['REQUEST_METHOD'] === $_GET) ? $_GET[$key] : $_POST[$key]);
    }
}
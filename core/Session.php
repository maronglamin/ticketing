<?php

namespace core;

class Session 
{
    public static function has($key)
    {
        return (bool) static::get($key);
    }

    public static function put($key, $value)
    {   
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function create($user)
    {
        $_SESSION['user'] = [
            'username' => $user['username'],
            'name' => $user['name'],
        ];

        session_regenerate_id(true);
    }

    public static function destroy()
    {
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    }

    public static function auth($key)
    {
        return authorize(($_SESSION['user']['username']) === $key ?? false);
    }

    public static function user()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['user']['username'];
    }

    public static function name()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['user']['name'];
    }

    public static function visible()
    {
        return !empty($_SESSION['user']['username']) ?? false;
    }
}
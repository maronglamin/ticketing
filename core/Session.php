<?php

namespace core;

use http\model\User\Users;

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

    // public static function entity()
    // {
    //     return empty($_SESSION) ? authorize(false) : Users::currentUser()['aps_entity'];
    // }

    public static function user()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['user']['username'];
    }

    public static function name()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['user']['name'];
    }

    public static function department()
    {
        return empty($_SESSION) ? authorize(false) : Users::currentUser()['department'];
    }

    public static function visible()
    {
        return !empty($_SESSION['user']['username']) ?? false;
    }

    public static function isBankPlay()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['aps_bankPayer'] === Response::IMF_BANK_USER;
    }

    public static function isOtherBankUser()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['aps_bankPayer'] === Response::BANK_USER;
    }

    public static function isAccountSignatory()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['aps_bankPayer'] === Response::ACCOUNT_SIGNATORY;
    }

    public static function entity()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['aps_entity'];
    }

    public static function isReviewer()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['auto_auth'] === Response::REV;
    }

    public static function isApprover()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['auto_auth'] === Response::AUTH;
    }

    public static function isInputter()
    {
        return empty($_SESSION) ? authorize(false) : $_SESSION['auto_auth'] === Response::INPUTTER;
    }
}

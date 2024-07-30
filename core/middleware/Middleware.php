<?php

namespace core\middleware;

use Exception;

class Middleware {

    public const MAP = [
        'guess' => Guess::class,
        'auth' => Auth::class
    ];

    public static function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;
        if(! $middleware) {
            new Exception("No matching middleware found for the key `{$key}`");
        }

        (new $middleware)->handle();
    }
}
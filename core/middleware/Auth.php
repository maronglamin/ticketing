<?php

namespace core\middleware;

use core\Response;

class Auth {

    public function handle() 
    {
        if (! $_SESSION['user'] ?? false ) {
            header('Location: ' . Response::PROOT . '/');
            exit();
        }
    }
}

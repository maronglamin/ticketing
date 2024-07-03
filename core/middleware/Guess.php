<?php

namespace core\middleware;

use core\Response;

class Guess {

    public function handle() 
    {
        if ($_SESSION['user'] ?? false ) {
            header('Location: ' . Response::PROOT);
            exit();
        }
    }
}
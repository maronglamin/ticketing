<?php

use core\Router;
use core\Session;
use core\DateTimeDiff;
use Http\model\ModelData;
use core\ValidationException;

ob_start();

const BASE_PATH = __DIR__. DIRECTORY_SEPARATOR;

require BASE_PATH .'core/function.php';

session_start();

spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});
require base_path('bootstrap.php');

$router = new Router();

$routes = require base_path('Http/resource/web.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception){
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirected($router->previousUrl());

}
Session::unflash();

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="fw-bold">Access Restricted</h1>
        <p class="lead">This system is currently unavailable for public access.</p>
        <p class="text-secondary">If you believe this is an error or require access, please contact the administrator.</p>
        <a href="mailto:itsupport@apswallet.gm" class="btn btn-primary">Contact Support</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->

<?php 
// die();

use core\Router;
use core\Session;
use core\DateTimeDiff;
use core\ValidationException;

ob_start();

const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR;
require BASE_PATH .'core/function.php';

session_start();

spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});
require base_path('bootstrap.php');

$router = new Router();

$routes = require base_path('http/resource/web.php');
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

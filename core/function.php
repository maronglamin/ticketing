<?php 

function dnd($value)
{
   echo '<pre>';

   var_dump($value);
    
   echo '</pre>';

   exit;
}

function shortText($string, $maxLength, $append)
{
    return substr($string, 0, $maxLength) . $append;
}

function sanitize($dirty)
{
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}
    
function authorize($condition, $status = core\Response::FORBIDEN)
{
    if(! $condition){
        abort($status);
    }
}


function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('view/partial/head.php');
    require base_path('view/partial/rightMenu.php');
    require base_path('view/partial/topMenu.php');
    
    require base_path('view/' . $path . '.php');

    require base_path('view/partial/footer.php');


}

function sessionSign($path, $attributes = [])
{
    extract($attributes);

    require base_path('view/partial/head-session.php');
    
    require base_path('view/' . $path . '.php');

    require base_path('view/partial/footer-session.php');

}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("view/http_response/{$code}.php");
    
    die();

}

function hashed($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function redirect($path) 
{
    header("Location: ". core\Response::PROOT . $path);
    exit();
}

function redirected($path) 
{
    header("Location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return core\Session::get('old')[$key] ?? $default;
}

function user()
{
    return core\Session::visible() ?? false;
}

function root()
{
    return core\Response::PROOT;
}

function cur_time()
{
    return date("Y-m-d H:i:s");
}

function previousCur_time()
{
    return date("Y-m-d H:i:s", strtotime('-26 hours'));
}

function month_year()
{
    return date("Y-m-d", strtotime('-2 hours'));
}

function previousDate()
{
    return date("Y-m-d", strtotime('-26 hours'));
}

function readDate($data)
{
    return date("D, d M Y", strtotime($data));
}

function readTime($data)
{
    return date("H:i a", strtotime($data));
}

function human($date)
{
    return date("d M, Y", strtotime($date));
}

function route($path)
{
    return root() . "/" . $path;
}

function is_request($key)
{
    return dnd(($_SERVER['REQUEST_METHOD'] === $_GET) ? $_GET[$key] : $_POST[$key]);
}

function flash($key)
{
    if (core\Session::get($key) !== null) {
        $string = '<div class="alert alert-primary alert-dismissible fade show ml-5 mr-5" role="alert">';
        $string .= core\Session::get($key) . '</div>';
        echo $string;
    }
}

function intended()
{
    return core\Router->previousUrl();
}

function text2cap($text) 
{
    return strtoupper($text);
}

function clientHost()
{
    return gethostbyaddr($_SERVER['REMOTE_ADDR']);
}

function deptPermission($deptName) {
    return http\model\User\Users::hasDepartment($deptName);
}
function department() {
    return core\Session::department();
}

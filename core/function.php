<?php 

use core\Router;
use http\model\User\Users;


if (!function_exists('dnd')) {
    function dnd(...$vars) {
        echo '<style>
                body {
                    background-color: #212529; /* Dark background for the body */
                    color: #ffffff; /* Default text color */
                }
                .dnd-output { 
                    background-color: #212529; /* Darker background for output */
                    border: 1px solid #495057; 
                    padding: 10px; 
                    border-radius: 5px; 
                    overflow-x: auto; 
                }
                .dnd-output pre {
                    margin: 0;
                    font-family: monospace;
                }
                .key { 
                    color: #ffffff; /* White for keys */
                }
                .value { 
                    color: #28a745; /* Hot orange for values */
                }
                .bracket { 
                    color: #dc3545; /* Red for brackets */
                }
              </style>';
        
        echo '<div class="dnd-output">';
        foreach ($vars as $var) {
            echo '<pre>';
            highlight_var_dump($var);
            echo '</pre>';
        }
        echo '</div>';
        die();
    }

    function highlight_var_dump($var) {
        ob_start(); // Start output buffering
        var_dump($var);
        $output = ob_get_clean(); // Get the output and clean buffer

        // Replace array keys, values, and brackets with styled HTML
        $output = preg_replace_callback('/(\[|\{|\}|\])/', function($matches) {
            return '<span class="bracket">' . $matches[0] . '</span>'; // Directly use $matches[0]
        }, $output);
        
        // Match key-value pairs and apply styles
        $output = preg_replace_callback('/([\'"]?)(\w+)([\'"]?:)/', function($matches) {
            return $matches[1] . '<span class="key">' . htmlspecialchars($matches[2]) . '</span>' . $matches[3];
        }, $output);

        // Match values after '=>' and apply styles, ensuring we don't capture unwanted characters
        $output = preg_replace_callback('/=>\s*(.*?)(?=\n|$)/', function($matches) {
            return '=> <span class="value">' . htmlspecialchars(trim($matches[1])) . '</span>';
        }, $output);
        
        // Clean up unwanted characters that might be captured
        $output = preg_replace('/\s*:\s*/', ': ', $output); // Normalize spacing around colons

        echo $output;
    }
}



function shortText($string, $maxLength, $append)
{
    if (strlen($string) > $maxLength) {
        return substr($string, 0, $maxLength) . $append;
    }
    return substr($string, 0, $maxLength);

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
    require base_path('view/partial/topNavBar.php');
    require base_path('view/partial/banner.php');
    
    require base_path('view/' . $path . '.php');

    require base_path('view/partial/externalFooter.php');

}

function userACL()
{
    return http\model\ModelData::userACL()['auto_auth'];
}

function ExternalView($path, $attributes = [])
{
    extract($attributes);

    require base_path('view/partial/externalHead.php');
    
    require base_path('view/' . $path . '.php');

    require base_path('view/partial/externalFooter.php');

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

function stringTime()
{
    return date("Ymdi");
}

function underlineDate()
{
    return date("d_m_Y_His");
}

function readMonthYear($data)
{
    return date("F", strtotime($data)). ' '.date("Y", strtotime($data));
}

function readMonthDay($data)
{
    return date("M d", strtotime($data));
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
    return date("d M Y", strtotime($data));
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
    $router = new Router();
    return $router->previousUrl();
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

function isSuperAdmin()
{
    return Users::superAdmin();
}

function isIntAdmin()
{
    return Users::intAdmin();
}
function isIMFAdmin()
{
    return Users::IMFAdmin();
}
function iswalletAdmin()
{
    return Users::walletAdmin();
}

function isBankPlay()
{
    return core\Session::isBankPlay();
}

function isReviewer()
{
    return core\Session::isReviewer();
}

function isApprover()
{
    return core\Session::isApprover();
}

function isInputter()
{
    return core\Session::isInputter();
}

function isAccountSignatory()
{
    return core\Session::isAccountSignatory();
}

function isOtherBankUser()
{
    return core\Session::isOtherBankUser();
}

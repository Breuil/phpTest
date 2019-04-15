<?php 

require_once "vendor/autoload.php";

require_once('C:xampp/htdocs/blog/components/header.php');

use Symfony\Component\Dotenv\Dotenv;

$env = getenv('ENV');
if (!$env || $env === 'dev') {
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__ . '/.env');
}

$class = "App\\Controller\\" . (isset($_GET['c']) ? ucfirst(strtolower($_GET['c'])) . 'Controller' : 'IndexController');
$action = isset($_GET['a']) ? $_GET['a'] : "index";

if (class_exists($class, true)) {
    $class = new $class();
    if (in_array($action, get_class_methods($class))) {
        call_user_func([$class, $action]);
        return;
    }
}
echo "404 - Error - Page not found";


?>
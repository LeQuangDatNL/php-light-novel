<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\PostController;
use App\Router;

require __DIR__. '/src/routes.php';

//$uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/index.php' || $uri === '' ) {
    $uri = '/';
}
$router->match($uri);


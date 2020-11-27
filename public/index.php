<?php

use vendor\core\Router;

try {
    $query = $_SERVER['QUERY_STRING'];

    define('WWW', __DIR__);
    define('CORE', dirname(__DIR__) . '/vendor/core');
    define('ROOT', dirname(__DIR__));
    define('APP', dirname(__DIR__) . '/app');
    define('LAYOUT', 'default');
    define('LIBS', dirname(__DIR__) . '/vendor/libs');
    session_start();

    require CORE . '/Router.php';
    require ROOT . '/routes/routes.php';
    require LIBS . '/rb-mysql.php';

    spl_autoload_register(function ($class) {
        $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
        if (is_file($file)) {
            require_once $file;
        }
    });

    Router::dispatch($query);
} catch (Exception $e) {
    echo 'Server on maintenance';
}

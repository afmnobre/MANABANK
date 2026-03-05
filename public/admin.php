<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../core/Autoload.php';

// O Router fará o resto, identificando que deve carregar os Controllers da pasta /admin
$router = new Router();
$router->run();

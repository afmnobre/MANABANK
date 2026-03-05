<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../core/Autoload.php';

// Como o Router e as outras classes estão no core/, o Autoload as carregará sob demanda.
$router = new Router();
$router->run();


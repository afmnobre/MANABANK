<?php

spl_autoload_register(function ($class) {
    // 1. Detecta se estamos no ambiente ADMIN ou APP
    // Verificamos se o script de entrada é o admin.php (pela URL ou pelo arquivo)
    $scriptName = basename($_SERVER['SCRIPT_FILENAME']);
    $isAdmin = ($scriptName === 'admin.php');

    // 2. Define os caminhos baseados na aplicação atual
    if ($isAdmin) {
        $directories = [
            __DIR__ . '/../admin/Controllers/',
            __DIR__ . '/../admin/Models/',
            __DIR__ . '/../core/'
        ];
    } else {
        $directories = [
            __DIR__ . '/../app/Controllers/',
            __DIR__ . '/../app/Models/',
            __DIR__ . '/../core/'
        ];
    }

    // 3. Busca e carrega a classe
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';

        // No Linux (Remoto), o file_exists diferencia maiúsculas de minúsculas
        if (file_exists($file)) {
            require_once $file;
            return; // Interrompe a busca assim que encontra
        }
    }
});


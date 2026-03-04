<?php

spl_autoload_register(function ($class) {

    $baseDir = __DIR__ . '/../';

    $paths = [
        $baseDir . 'app/Models/',    // Prioridade para o App
        $baseDir . 'admin/Models/',  // Depois olha no Admin
        $baseDir . 'app/Controllers/',
        $baseDir . 'admin/Controllers/',
        $baseDir . 'core/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});


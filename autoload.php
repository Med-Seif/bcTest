<?php

spl_autoload_register(function ($class) {
    $locations = [
        'src',
        'lib'
    ];

    foreach ($locations as $location) {

        $base_dir = __DIR__ . '/' . $location . '/';

        $file = $base_dir . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

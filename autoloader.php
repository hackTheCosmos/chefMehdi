<?php

// Autoloader
spl_autoload_register(function ($class_name) {
    // classes
    $file_name = "classes/".$class_name.".php";
    
    if (file_exists($file_name)) {
        require_once $file_name;
    }
    
    // controllers
    $file_name = "controllers/".$class_name.".php";
    if (file_exists($file_name)) {
        require_once $file_name;
    }
});
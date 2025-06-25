<?php


namespace inc;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $prefix = '';
            $base_dir = THEME_PATH . '/';

            $class = ltrim($class, '\\');
            $file = $base_dir . str_replace('\\', '/', $class) . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}



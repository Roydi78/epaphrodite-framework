<?php
namespace bin;

class Autoloader8a0850d910f7ed29d338458ec07b85a{

    public static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    private static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require _DIR_MAIN_ . '/'. $class . '.php';
        }
    }
}

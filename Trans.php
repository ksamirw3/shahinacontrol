<?php

namespace JConsole;

require __DIR__ . '/bootstrap/autoload.php';

$file = __DIR__ . "\\resources\\views\\components\\asaid.blade.php";

class File {

    public static function read($file) {
        return file_get_contents($file);
    }

    public static function spiltToarray($file) {
        $text = self::read($file);
        return explode('__(', $text);
    }
    
    public static function spiltToarray($file) {
        $text = self::read($file);
        return explode('__(', $text);
    }

}

dd(File::spiltToarray($file));

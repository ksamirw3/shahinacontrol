<?php

namespace Amit\CouchBase;

class ExeptionHandler {

    public static function jsExiptionViewer($text) {
        if (env('APP_DEBUG') == true) {
            echo '<script>console.log(" %c' . str_replace("'", '\'',
                str_replace('"', '\"', $text)) . '","color:red;")</script>';
        }
    }
}
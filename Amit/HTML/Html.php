<?php

namespace Amit\HTML;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Html
 *
 * @author jooaziz
 */
class Html {

    public static function lable($text) {
        return new Components\Label($text);
    }

    public static function input($name, $val = '', $attrs = []) {
        return new Components\Input($name, $val, $attrs);
    }

    public static function image($src) {
        return new Components\Image($src);
    }

    public static function video() {

    }

}

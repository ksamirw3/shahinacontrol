<?php

namespace Amit\HTML\Components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author jooaziz
 */
class Helper {

    public static function parseClass(array $class) {
        if (empty($class)) return "";
        return "class=\"" . implode(' ', $class) . "\"";
    }

    public static function parseAttres(array $attres) {
        $rt = '';
        foreach ($attres as $attr) {
            $rt.= " $attr[0]=\"$attr[1]\" ";
        }
        return $rt;
    }

}

<?php

namespace Amit\CB;

use \Amit\Settings\Genral;

class ExeptionHandler {

    private static $count;

    public static function jsExiptionViewer($text) {
        if (Genral::debuge() && Genral::devMode()) self::pritMessage($text);
    }

    private static function pritMessage($text) {
        $top = self::$count++ * 90;
        echo "<div class='alert alert-danger' style='
                position: absolute;
                max-width:450px;
                top: {$top}px;
                    height:50px;
                    overflow:auto;
                z-index:1000000000000000;
                left: 20px;
                margin-top:10px;
                padding: 15px;
                background: #ed8787;
                color: #620505;
                   '>
                  <span style='display: block;margin-bottom: 15px;border-bottom: thin solid #660000;cursor: pointer' onclick='this.parentNode.remove()'>X</span>
                {$text}
                </div>";
    }

}

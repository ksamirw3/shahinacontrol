<?php

namespace Amit\Support;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cls
 *
 * @author jooaziz
 */
class Cls {

    public static function className($obj) {
        $nameSpaceParts = explode('\\', get_class($obj));
        return strtolower(end($nameSpaceParts));
    }

    public static function getPROTECTEDAttrs($obj) {
        return self::getPropertiesModifire($obj,
                \ReflectionProperty::IS_PROTECTED);
    }

    public static function getPUBLICAttrs($obj) {
        return self::getPropertiesModifire($obj, \ReflectionProperty::IS_PUBLIC);
    }

    private static function getPropertiesModifire($obj, $modifir) {
        $rt = [];
        $reflection = new \ReflectionObject($obj);
        $properties = $reflection->getProperties($modifir);
        foreach ($properties as $pro) {
            $rt[] = $pro->name;
        }
        return $rt;
    }
}
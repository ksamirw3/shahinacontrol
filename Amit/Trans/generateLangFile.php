<?php

namespace Amit\Tranc;

use File;

class generateLangFile {

    private static function generat($string, $start, $end) {
        $return = [];
        $split_string = explode($start, $string);
        if (isset($split_string[0])) unset($split_string[0]);
        foreach ($split_string as $data) {
            $res = explode(')', $data);
            $w = explode('.',
                str_replace('"', '', str_replace('\'', '', $res[0])));
            if (isset($w[1])) @$return[$w[0]][$w[1]] = $w[1];
        }
        return $return;
    }

    /**
     *
     * this method extraact __('example.example')
     * from enterd string
     *
     *
     * @param type $string
     * @return array
     */
    public static function getTransFromFile($string) {
        return self::generat($string, '__(', ')');
    }

    public static function transLangDir($dir) {
        $res = [];
        $files = \Amit\Files\Scaner::scanDirRecursive($dir);
        foreach ($files as $file) {
            if (!is_dir($file)) {
                $arrs = self::getTransFromFile(File::get($file));
                if (!empty($arrs))
                        foreach ($arrs as $k => $v)
                            foreach ($v as $i => $j) $res[$k][$j] = $j;
            }
        }
        return $res;
    }
}
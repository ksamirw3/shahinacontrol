<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Support;

use Amit\Utilites\Request\QueryString;

/**
 * Description of Arr
 *
 * @author jooaziz
 */
class Arr {

    public static function SortArraySecandLevel($arr, $key) {
        usort($arr, function ($item1, $item2) use($key) {
            if (is_array($item1) && is_array($item2)) {
                if ($item1[$key] == $item2[$key])
                    return 0;
                return ($item1[$key] < $item2[$key]) ? 1 : -1;
            } else {
                if ($item1->$key == $item2->$key)
                    return 0;
                return ($item1->$key < $item2->$key) ? 1 : -1;
            }
        });
        return $arr;
    }

    public static function SortArrayFirstLevel($arr) {
        arsort($arr);
        return $arr;
    }

    public static function getByKey($arr, $key) {
        $rt = [];
        foreach ($arr as $row) {
            if (is_array($row)) {
                $rt[] = $row[$key];
            } else {
                $row = (array) $row;
                $rt[] = $row[$key];
            }
        }
        return $rt;
    }

    public static function queryToString(array $query) {
        return new QueryString($query);
    }

}

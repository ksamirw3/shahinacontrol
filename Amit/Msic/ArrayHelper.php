<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayHelper
 *
 * @author jooaziz
 */
class ArrayHelper {

    public static function SortArraySecandLevel($arr, $key) {
        usort($arr, function ($item1, $item2) use($key) {
            if (is_array($item1) && is_array($item2)) {
                if ($item1[$key] == $item2[$key]) return 0;
                return ($item1[$key] < $item2[$key]) ? 1 : -1;
            } else {
                if ($item1->$key == $item2->$key) return 0;
                return ($item1->$key < $item2->$key) ? 1 : -1;
            }
        });
        return $arr;
    }

    public static function SortArrayFirstLevel($arr) {
        arsort($arr);
        return $arr;
    }

}

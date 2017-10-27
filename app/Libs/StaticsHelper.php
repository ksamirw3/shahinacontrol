<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Libs;

/**
 * Description of StaticsHelper
 *
 * @author PHP_Developer
 */
class StaticsHelper {

    private static $data;
    private static $forIncome = false;
    private static $monArray = ['1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sept', '10' => 'Oct',
        '11' => 'Nov', '12' => 'Dec',];

    public static function publisherByYear($data, $field = 'count',
        $forIncome = false) {
        self::$data = $data;

        if (empty($data->rows)) return false;

        $rt = self::refactor(self::$data->rows, $field, $forIncome);

        return (object) ['data' => $rt, 'thisYear' => self::turnOverJsonObj(self::thisYear($rt))];
    }

    public static function refactor($data, $field, $forIncome) {
        $rt = [];
        foreach ($data as $ky => $y) {
            foreach ($y as $km => $m) {
                if (!isset($rt[$ky])) $rt[$ky] = [];
                if (!isset($rt[$ky][$km])) $rt[$ky][$km] = new \stdClass();
                $rt[$ky][$km]->month = self::makeMonthKey($km, $ky, $forIncome);
                $rt[$ky][$km]->count = self::$field($m);
            }
        }
        return $rt;
    }

    public static function makeMonthKey($mon, $year, $forIncome) {
        if (!$forIncome) return $mon;
        $months = array_flip(self::$monArray);
        self::$forIncome = true;
        return $year . '-' . $months[$mon];
    }

    public static function count($arr) {
        return count($arr);
    }

    public static function sum($arr) {
        return array_sum($arr);
    }

    public static function thisYear($data) {
        $thisYear = isset($data[date('Y')]) ? $data[date('Y')] : [];
        $thisYearArr = [];

//        $monthes = (self::$forIncome) ? array_flip(self::$monArray) : self::$monArray;
        $monthes = self::$monArray;
        foreach ($monthes as $mon) {
            if (isset($thisYear[$mon])) {
                $thisYearArr[] = $thisYear[$mon];
            }
            else {
                $thisYearArr[] = (self::$forIncome) ? (object) ['month' => self::makeMonthKey($mon,
                            date('Y'), TRUE), 'count' => 0] : (object) ['month' => $mon,
                        'count' => 0];
            }
        }
        self::$forIncome = false;
//        dd($thisYearArr);
        return $thisYearArr;
    }

    public static function turnOverJsonObj($data) {
        return (object) ['data' => $data, 'json' => json_encode($data)];
    }
}
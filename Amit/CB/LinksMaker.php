<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\CB;

use Request;

/**
 *
 * @author jooaziz
 */
class LinksMaker {

    private static $url;
    private static $page;
    private static $currentPage;
    private static $num_of_pages;
    private static $newQueryString;
    private static $prePage;

    public static function get($total, $prePage) {
        self::$prePage = $prePage;
        self::init($total);
        if ($total < self::$prePage) return null;
        return self::genrateHtml();
    }

    private static function init($total) {
        self::$url = Request::url() . "?";
        self::$page = 1;
        self::$currentPage = (Request::get('page'))? : 1;
        self::$num_of_pages = (int) ceil($total / self::$prePage);
//        dd(self::$num_of_pages);
        self::makeQueryString(self::getQueryString());
    }

    private static function getQueryString() {
        $queryString = $_SERVER['QUERY_STRING'];
        parse_str($queryString, $parm);
        return $parm;
    }

    private static function makeQueryString($oldQuery) {
        unset($oldQuery['page']);
        $newQuery = '';
        if (count($oldQuery) > 0) {
            foreach ($oldQuery as $key => $value) {
                $newQuery.= $key . '=' . $value . '&';
            }
            $newQuery.="page=";
        } else {
            $newQuery.="page=";
        }
        return self::$newQueryString = $newQuery;
    }

    private static function genrateHtml() {

        $string = '<ul class="pagination">';

        $string.=self::prevBtn();
        $string.=self::pages();



        $string.=self::nextBtn();

        $string.="</ul>";
        return $string;
    }

    private static function nextBtn() {
        if (self::$currentPage != 0 && self::$currentPage < self::$num_of_pages) $link = self::$url . self::$newQueryString . (self::$currentPage + 1);
        else $link = 'javascript:void(0)';
        return "<li><a href='{$link}'  aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
    }

    private static function prevBtn() {
        if (self::$currentPage != 1 && (self::$currentPage) <= self::$num_of_pages) $link = self::$url . self::$newQueryString . (self::$currentPage - 1);
        else $link = 'javascript:void(0)';
        return "<li><a href='{$link}' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
    }

    private static function pages() {
        $string = '';
        for ($i = 1; $i <= self::$num_of_pages; $i++) {
            if ($i == (int) self::$currentPage) {
                $active = "active";
                $link = 'javascript:void(0)';
            } else {
                $active = "";
                $link = self::$url . self::$newQueryString . self::$page;
            }
            $string.="<li class='{$active}'><a href='{$link}'>" . self::$page . "</a></li>";

            self::$page++;
        }
        return $string;
    }

}

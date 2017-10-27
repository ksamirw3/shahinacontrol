<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author PHP_Developer
 */

namespace Amit\Msic;

use Request;

/**
 *
 * Adds a relationship between two entities using the given relation type.
 * Show off .
 *
 *
 */
class Pagination {

    /**
     *
     * @param int $total number of total rows
     * @return string html list of pagination
     */
    public static function render($total) {
        $queryString = $_SERVER['QUERY_STRING'];
        parse_str($queryString, $parm);
        unset($parm['page']);
        $query_string = '';
        if (count($parm) > 0) {
            foreach ($parm as $key => $value) {
                $query_string.= $key . '=' . $value . '&';
            }
            $query_string.="page=";
        }
        else {
            $query_string.="page=";
        }
        $url = Request::url() . "?";
        $page = $currentPage = (Request::get('page'))? : 1;
        $num_of_pages = (int) ceil($total / config('constants.perPage'));
        $string = '<ul class="pagination">';
        if ($currentPage != 1 && ($currentPage) <= $num_of_pages) {
            $string.="<li><a href='" . $url . $query_string . ($currentPage - 1) . "' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        else {
            $string.="<li  class='disabled'><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        for ($i = 0; $i < config('constants.perLink'); $i++) {
            if (($page <= $num_of_pages)) {
                $parm['page'] = $page;
                $active = ($i == 0) ? "active" : "";
                $string.="<li class='{$active}'><a href='" . $url . $query_string . $page . "'>" . $page . "</a></li>";
            }
            $page++;
        }
        if ($currentPage != 0 && ($currentPage) < $num_of_pages) {
            $string.="<li><a href='" . $url . $query_string . ($currentPage + 1) . "'  aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
        }
        else {
            $string.="<li  class='disabled'><a href='#'  aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
        }
        $string.="</ul>";
        return $string;
    }
}
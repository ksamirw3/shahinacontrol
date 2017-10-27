<?php

namespace App\Helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Glopal
 *
 * @author PHP_Developer
 */
class Glopal {

    public function jsExiptionViewer($text) {
        if (env('APP_DEBUG') == true) {
//            echo $text;
            echo '<script>console.log(" %c' . str_replace('"', '\"', $text) . '","color:red;")</script>';
        }
    }

    public function getUrl() {
        $u = request()->fullUrl();
        $parts = explode('?', $u);
        if (!isset($parts[1])) return $u . '?';
        $uArr = explode('&', $parts[1]);
        foreach ($uArr as $i => $item) {
            if (strtolower(substr($uArr[$i], 0, 5)) === 'page=') {
                unset($uArr[$i]);
            }
        }
        return $parts[0] . '?' . implode('&', $uArr) . '&';
    }

    public function pagination($total_pages, $limit, $page, $url) {

        $URL = $this->getUrl();
//        dd($URL);
        $lastpage = ceil($total_pages / $limit);
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul style='width: auto; margin: 0 auto;' class=\"pagination\">";

            for ($i = 0; $i < $lastpage; $i++) {
                $ii = $i + 1;

                if ($i == $page) {
                    $pagination.= "<li class=\"active\"><a>$ii</a></li>";
                }
                else {
                    $pagination.= "<li><a href=\"$URL" . "page=$ii\">$ii</a></li>";
                }
            }
            $pagination.= "</ul>\n";
        }

        return $pagination;
    }
}
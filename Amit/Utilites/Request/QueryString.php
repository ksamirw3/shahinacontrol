<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Utilites\Request;

/**
 * Description of QueryString
 *
 * @author jooAziz
 */
class QueryString {

    private $str = '';
    private $dataBeforProssing = [];
    private $url = '';

    public function __construct($query) {
        $this->dataBeforProssing = $query;
    }

    /**
     *  append key and valu to array
     * @param type $key
     * @param type $val
     * @return \Amit\Utilites\Request\QueryString
     */
    public function append($key, $val) {
        $this->dataBeforProssing[$key] = $val;
        return $this;
    }

    /**
     *  this magic method called when you use this object as string
     * @return String
     */
    public function __toString() {
        return $this->doConvertArrayToString($this->dataBeforProssing);
    }

    /**
     * main method that do whal work
     * @param type $query
     * @return type
     */
    private function doConvertArrayToString($query) {
        if (!empty($query)) {
            $this->str = '?';
            foreach ($query as $key => $val) {
                $this->str.=$key . '=' . $val . '&';
            }
            $this->str = rtrim($this->str, "&");
        }
        return $this->url . $this->str;
    }

    /**
     * 
     * @return \Amit\Utilites\Request\QueryString
     */
    public function fullURL() {
        $this->url = request()->url();
        return $this;
    }

    /**
     * 
     * @param type $filed
     * @param type $type
     * @return type
     */
    public static function orderByQueryBilder($filed, $type) {
        return (new static(request()->all()))->append('order', $filed)->append('order_type', $type)->fullURL();
    }

}

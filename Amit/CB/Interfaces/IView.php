<?php

namespace Amit\CB\Interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jooaziz
 */
interface IView extends IViewResultModifire {

    public function in($view);

    public function where($key, $value);

    /**
     *
     * this will  return only array list
     * of key passed (first arg)
     *
     * if id (secand arg) found it will be key of return result
     *
     * @param string $key
     * @param string $id
     */
}

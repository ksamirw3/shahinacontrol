<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Msic;

/**
 * Description of Route
 *
 * @author jooaziz
 */
class Route {

    /**
     * retrive prefix name from url
     * ex : admin,provider,publisher
     * @return type
     */
    public static function getPrefix() {
        return strtolower(str_replace('/', '', \Route::getCurrentRoute()->getPrefix()));
    }

    /**
     * retrive current method name from url
     * ex : getIndex,postEdit
     * @return type
     */
    public static function getActionName() {
        return explode('@', \Route::getCurrentRoute()->getActionName())[1];
    }

    public static function getController() {

        list($controller, $action) = explode('@', class_basename(app('request')->route()->getAction()['controller']));
        return strtolower($controller);
    }

}

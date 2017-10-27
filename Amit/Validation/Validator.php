<?php

namespace Amit\Validation;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Validator as OrginaValidator;

class Validator {

    /**
     * this method is bootstrap of class and it call all static method automaticly
     *
     * so please dont` change it
     *
     */
    public static function init() {
        /*
         * get class info
         */
        $reflection = new \ReflectionClass(self::class);
        /*
         * get static methods
         */
        $methods = $reflection->getMethods(\ReflectionMethod::IS_STATIC);
        forEach ($methods as $method)
            if ($method->name != '__construct' && $method->name != 'init')
                self::{$method->name}();
    }

    /**
     * if value = only space it will fail
     */
    public static function richTextValidator() {
        OrginaValidator::extend('richtext', function($attribute, $value, $parameters, $validator) {

            $val = $value;
            // remove html tages
            $val = strip_tags($val);
            //remove " " from string
            $val = str_replace(" ", '', $val);
            //remove "&nbsp;" from string
            $val = str_replace("&nbsp;", "", $val);


            if ($val == "")
                return false;return true;
        });
    }

    /**
     * if vaule is only a number it fail
     */
    public static function alpha_num_str() {
        OrginaValidator::extend('alpha_num_str', function($attribute, $value) {
            return !is_numeric($value);
        });
    }

    /**
     *
     */
    public static function couchUniqe() {
        OrginaValidator::extend('couch_uniqu', function($attribute, $value, $parameters, $validator) {

            /*
             * get class name for use it
             */
            $class = "\App\Models\\" . ucfirst(strtolower($parameters[0]));
            /*
             * check if view is defaind or fail
             */
            $view = (@$parameters[1])? : abort(404, "viewe not defiend");
            /**
             * check if id passed
             */
            $id = (@$parameters[2])? : null;
            /*
             * check if class found or fail
             */
            if (!class_exists($class))
                abort(404, "class $class not found");
            /*
             * send request to data base
             */
            $res = ( new $class)->in($view)->where('key', trim(strtolower($value)))->first();
            /*
             * if result founad and it`s id == to id then return true
             */
            if (!is_null($res) && !is_null($id))
                return ($res->id == $id) ? true : false;
            /*
             * if there is an result and ther is no id then false
             */
            if (!is_null($res))
                return false;
            /**
             *
             */
            return true;
        });
    }

    public static function multiFiles() {
        OrginaValidator::extend('multiFiles', function($attribute, $value) {
            if (is_null($value[0]))
                return false;
            return true;
        });
    }

    public static function non_special() {
        OrginaValidator::extend('non_special', function($attribute, $value) {
            return  (false === strpbrk($value, "!#@$%^&*()+=-[]';,./{}|:<>?~"))?TRUE:FALSE;
        });
    }

}

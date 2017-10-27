<?php

namespace Amit\Msic;

use Session;
use App;
use Request;

class Lang {

    private static $seesionVarName = "language";

    public static function init() {
        self::setDefault();
        self::set(Request::get("language"));
    }

    public static function set($lang) {
        if (!is_null($lang)) {
            Session::set(self::$seesionVarName, $lang);
            self::setLocal();
            return redirect()->back()->send();
        }
    }

    public static function get() {
        return Session::get(self::$seesionVarName);
    }

    public static function setDefault() {
        if (!@Session::has(self::$seesionVarName)) {
            Session::set(self::$seesionVarName, \Amit\Settings\Lang::getDefaultLang());
        }
        self::setLocal();
    }

    public static function setLocal() {
        App::setLocale(Session::get(self::$seesionVarName));
    }

    public static function isArabic() {
        return (Session::get(self::$seesionVarName) == 'ar') ? TRUE : FALSE;
    }

}

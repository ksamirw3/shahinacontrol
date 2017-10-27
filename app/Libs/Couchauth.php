<?php

namespace App\Libs;

use App\Models\User;
use Session;
use Hash;
use Config;

class Couchauth {

    public static function attempt($credentials, $remember = 0) {
        extract($credentials);
//        $row = User::where('username', "=", $username)->whereConfirmed(1)->first();
//        if ($row) {
//            if (Hash::check($password, $row->password)) {
//                Session::put('couch_user', $row);
//                Session::put('couch_permissions',
//                    $row->roles->lists('slug', 'id')->toArray());
//                return $row;
//            }
//        }
        $row = 1;
        if ($row) {
            return $row;
        }
    }

    public static function user() {
        $key = Config::get('application.key');
        if (Session::has('couch_user')) {
            $user = Session::get('couch_user');
            return $user;
        }
        else return false;
    }

    public static function id() {
        if (Session::has('couch_user')) {
            $user = Session::get('couch_user');
            return @$user->id;
        }
    }

    public static function guest() {
        if (!Session::has('couch_user')) return true;
        else return false;
    }

    public static function logout() {
        Session::forget('couch_user');
        return true;
    }

    public static function permissions() {
        if (Session::has('couch_permissions')) {
            $permissions = Session::get('couch_permissions');
            return $permissions;
        }
    }
}
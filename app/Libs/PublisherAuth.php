<?php

namespace App\Libs;

use App\Models\Admin;
use Session;
use Hash;
use Config;

class PublisherAuth {

    public static function update_user($row) {
        $key = Config::get('application.key');
        Session::put($key . 'publisher_user', $row);
    }

    public static function update_roles($roles) {
        $key = Config::get('application.key');
        Session::put($key . 'publisher_roles', $row);
    }

    public static function user() {
        $key = Config::get('application.key');
        if (Session::has($key . 'publisher_user')) {
            $user = Session::get($key . 'publisher_user');
            return $user;
        }
    }

    public static function id() {
        $key = Config::get('application.key');
        if (Session::has($key . 'publisher_user')) {
            $user = Session::get($key . 'publisher_user');
            return @$user->id;
        }
    }

    public static function guest() {
        $key = Config::get('application.key');
        if (!Session::has($key . 'publisher_user')) return true;
        else return false;
    }

    public static function logout() {
        $key = Config::get('application.key');
        Session::forget($key . 'publisher_user');
        Session::forget($key . 'publisher_roles');
        return true;
    }

    public static function roles() {
        $key = Config::get('application.key');
        if (Session::has($key . 'publisher_roles')) {
            $roles = Session::get('publisher_roles');
            return $roles;
        }
    }
}
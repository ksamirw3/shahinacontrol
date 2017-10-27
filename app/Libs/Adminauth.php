<?php

namespace App\Libs;

class Adminauth {

    public static function update_user($row) {
        $key = env('APP_KEY');
        \Session::put($key . 'admin_user', $row);
//        dd(\\Session::get(null));
    }

    public static function update_roles($roles) {
        $key = env('APP_KEY');
        \Session::put($key . 'admin_roles', $roles);
    }

    public static function user() {
        $key = env('APP_KEY');
        if (\Session::has($key . 'admin_user')) {
            $user = \Session::get($key . 'admin_user');
            return $user;
        }
    }

    public static function id() {
        $key = env('APP_KEY');
        if (\Session::has($key . 'admin_user')) {
            $user = \Session::get($key . 'admin_user');
            return @$user->id;
        }
    }

    public static function guest() {
        $key = env('APP_KEY');
        if (!\Session::has($key . 'admin_user')) return true;
        else return false;
    }

    public static function logout() {
        $key = env('APP_KEY');
        \Session::forget($key . 'admin_user');
        \Session::forget($key . 'admin_roles');
        return true;
    }

    public static function roles() {
        $key = env('APP_KEY');
        if (\Session::has($key . 'admin_roles')) {
            $roles = \Session::get('admin_roles');
            return $roles;
        }
    }
}
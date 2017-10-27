<?php

namespace App\Libs\MiddlewareHelper;

use Session;
use Config;

class ProviderAuth {

    public static function update_user($row) {
        $key = env('APP_KEY');
        Session::put($key . 'provider_user', $row);
    }

    public static function update_roles($roles) {
        $key = env('APP_KEY');
        Session::put($key . 'provider_roles', $row);
    }

    public static function user() {
        $key = env('APP_KEY');
        if (Session::has($key . 'provider_user')) {
            $user = Session::get($key . 'provider_user');
            return $user;
        }
    }

    public static function id() {
        $key = env('APP_KEY');
        if (Session::has($key . 'provider_user')) {
            $user = Session::get($key . 'provider_user');
            return @$user->id;
        }
    }

    public static function guest() {
        $key = env('APP_KEY');
        if (!Session::has($key . 'provider_user')) return true;
        else return false;
    }

    public static function logout() {
        $key = env('APP_KEY');
        Session::forget($key . 'provider_user');
        Session::forget($key . 'provider_roles');
        return true;
    }

    public static function roles() {
        $key = env('APP_KEY');
        if (Session::has($key . 'provider_roles')) {
            $roles = Session::get('provider_roles');
            return $roles;
        }
    }

}

<?php

namespace App\Http\Controllers\Api\Driver\Users;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/driver/users/';

    public function rules() {
        if ($this->is('login')) {
            return self::login();
        } elseif ($this->is('logout')) {
            return self::logout();
        } elseif ($this->is('update-key')) {
            return self::token();
        } elseif ($this->is('update-token')) {
            return self::token();
        }elseif ($this->is('reset-password')) {
            return self::resetPassword();
        }elseif ($this->is('forget-password')) {
            return self::forgetPassword();
        }elseif ($this->is('view-profile')) {
            return self::viewProfile();
        }elseif ($this->is('update-status')) {
            return self::updateStatus();
        } elseif ($this->is('update-location')) {
            return self::updateLocation();
        }

        return [];
    }

    private static function token() {
        return [ 'id' => 'required', 'token' => 'required',];
    }

    private static function login() {
        return [ 'username' => 'required', 'password' => 'required',];
    }

    private static function logout() {
        return [ 'id' => 'required'];
    }

    private static function resetPassword()
    {
        return [
        'id' => 'required',
        'password' => 'required',
        'new_password' => 'required',
        're_password' => 'required|same:new_password',
        ];
    }

    private static function forgetPassword() {
        return [
        'email' => 'required|email',
        ];
    }

    private static function viewProfile()
    {
        return [
        'id' => 'required',
        ];
    }

    private static function updateStatus()
    {
        return [
        'id' => 'required',
        'status' => 'required|digits_between:0,1',
        ];
    }

    private static function updateLocation() {
        return [
        'id' => 'required',
        'longitude' => 'required',
        'latitude' => 'required'
        ];
    }

}

//?username = df&password = 123456789&longitude = 55&latitude = 23
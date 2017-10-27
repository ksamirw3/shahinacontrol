<?php

namespace App\Http\Controllers\Api\Client\Users;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/client/users/';

    public function rules() {
        if ($this->is('login')) {
            return self::login();
        } elseif ($this->is('logout')) {
            return self::logout();
        } elseif ($this->is('update-key')) {
            return self::token();
        } elseif ($this->is('update-token')) {
            return self::token();
        } elseif ($this->is('register')) {
            return self::register();
        } elseif ($this->is('update-location')) {
            return self::updateLocation();
        } elseif ($this->is('forget-password')) {
            return self::forgetPassword();
        } elseif ($this->is('update-profile')) {
            return self::updateProfile();
        } elseif ($this->is('reset-password')) {
            return self::resetPassword();
        } elseif ($this->is('view-profile')) {
            return self::viewProfile();
        } elseif ($this->is('update-status')) {
            return self::updateStatus();
        }

        return [];
    }

    private static function register() {
        return [
//            'username' => 'required|unique:users,username',
            'f_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|digits_between:4,14|unique:users,phone',
        ];
    }

    private static function updateLocation() {
        return [
            'id' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ];
    }

    private static function forgetPassword() {
        return [
            'email' => 'required|email',
        ];
    }

    private static function token() {
        return ['id' => 'required', 'token' => 'required',];
    }

    private static function login() {
        return ['phone' => 'required', 'password' => 'required',];
    }

    private static function logout() {
        return ['id' => 'required'];
    }

    private static function updateProfile() {
        return [
            'id' => 'required',
            // 'username' => 'required|unique:users,username,'.request()->id,
            'email' => 'required|email|unique:users,email,' . request()->id,
            'password' => 'required_with:old_password|digits_between:4,14',
            'old_password' => 'required_with:password',
            'phone' => 'required|digits_between:4,14|unique:users,phone,' . request()->id,
            'f_name' => 'required',
        ];
    }

    private static function resetPassword() {
        return [
            'id' => 'required',
            'password' => 'required',
            'new_password' => 'required',
            're_password' => 'required|same:new_password',
        ];
    }

    private static function viewProfile() {
        return [
            'id' => 'required',
        ];
    }

    private static function updateStatus() {
        return [
            'id' => 'required',
            'status' => 'required|digits_between:0,1',
        ];
    }

}

//?username = df&password = 123456789&longitude = 55&latitude = 23
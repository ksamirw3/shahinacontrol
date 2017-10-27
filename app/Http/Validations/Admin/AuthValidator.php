<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Validations\Admin;

/**
 * Description of AuthValidator
 *
 * @author jooaziz
 */
class AuthValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/auth/';

    public function rules() {
        if ($this->is($this->myUrl . 'login')) {
            return $this->login();
        } elseif ($this->is($this->myUrl . 'forgot-password')) {
            return $this->forgetPassword();
        }
        return parent::rules();
    }

    protected function login() {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    protected function forgetPassword() {
        return [ 'email' => 'required|email'];
    }

    protected function validatCreate() {

    }

    protected function validatEdit() {

    }

//put your code here
}

<?php

namespace App\Http\Validations\Admin;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author jooaziz
 */
class AdminValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/admins/';

    public function rules() {
        if ($this->is($this->myUrl . 'edit-account')) {
            return $this->validatEditAccount();
        } else if ($this->is($this->myUrl . 'change-password')) {
            return $this->validatChangePassword();
        }
        return parent::rules();
    }

    private function validatEditAccount() {
        return[
            'username' => 'required|non_special|unique:admins,username,' . $this->get('id'),
            'email' => 'required|email|unique:admins,email,' . $this->get('id'),
            'phone' => 'digits_between:4,14'
        ];
    }

    private function validatChangePassword() {
        return[
            'old_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        ];
    }

    protected function validatCreate() {
        return[
            'rule_id' => 'required',
            'username' => 'required|non_special|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'phone' => 'digits_between:4,14',
        ];
    }

    protected function validatEdit() {
        return[
            'rule_id' => 'required',
            'username' => 'required|non_special|unique:admins,username,' . $this->get('id'),
            'email' => 'required|email|unique:admins,email,' . $this->get('id'),
            'phone' => 'digits_between:4,14',
        ];
    }

}

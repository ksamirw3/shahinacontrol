<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Validations\Admin;

/**
 * Description of GroupesValidator
 *
 * @author jooaziz
 */
class DreiversValidatio extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/drivers/';
    protected $myTabel = 'drivers';

    public function rules() {
        if ($this->is($this->myUrl . 'change-password/*')) {
            return [
            'password' => "required",
            ];
        }
        return parent::rules();
    }

    protected function validatCreate() {
        return [
            'username' => "required|unique:{$this->myTabel},username",
            'password' => "required",
            'email' => "required|unique:{$this->myTabel},email",
            'phone' => "required|unique:{$this->myTabel},phone",
        ];
    }

    protected function validatEdit() {
        return [
            'username' => "required|unique:{$this->myTabel},username," . $this->get('id'),
            'email' => "required|unique:{$this->myTabel},email," . $this->get('id'),
            'phone' => "required|unique:{$this->myTabel},phone," . $this->get('id'),
        ];
    }

//put your code here
}

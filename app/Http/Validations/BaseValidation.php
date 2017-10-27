<?php

namespace App\Http\Validations;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseValidation
 *
 * @author jooaziz
 */
Abstract class BaseValidation extends \Illuminate\Foundation\Http\FormRequest {

    protected $myUrl;

    public function authorize() {
        return true;
    }

    abstract protected function validatCreate();

    abstract protected function validatEdit();

    public function rules() {
        if ($this->is($this->myUrl . 'create')) {
            return $this->validatCreate();
        }
        else if ($this->is($this->myUrl . 'edit/*')) {
            return $this->validatEdit();
        }
        return [];
    }
}
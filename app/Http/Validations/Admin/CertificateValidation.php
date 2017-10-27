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
class CertificateValidation extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/certificates/';

    protected function validatCreate() {
        return['name' => 'required|non_special|unique:certificates,name'];
    }

    protected function validatEdit() {
        return['name' => 'required|non_special|unique:certificates,name,' . $this->get('id')];
    }

//put your code here
}

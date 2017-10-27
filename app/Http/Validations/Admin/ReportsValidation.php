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
class ReportsValidation extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/reports/';

    public function rules() {
        if ($this->is($this->myUrl . 'send-students-certificate')) {
           return $this->sendStudentsCertificate();
        }
        if ($this->is($this->myUrl . 'check-vlaidate')) {
           return $this->sendStudentsCertificate();
        }
        return parent::rules();
    }

    protected function sendStudentsCertificate() {
        return [
        "group_id" => "required",
        "certificate_id" => "required"
        ];
    }

    protected function validatCreate() {
        return [];
    }

    protected function validatEdit() {
        return [];
    }

//put your code here
}

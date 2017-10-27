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
class StudentsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/students/';

    public function rules() {
        if ($this->is($this->myUrl . 'student'))
            return[ 'phone' => 'required'];
        return parent::rules();
    }

    protected function validatCreate() {
//        dd($this->all());
        return self:: getRules();
    }

    protected function validatEdit() {
        $data = self:: getRules();
        $data['mobile'] .= ',' . $this->get('id');
        return$data;
    }

    public static function getRules() {
        return[
            'name' => 'required|non_special',
            'email' => 'required|email',
            'mobile' => 'required|digits_between:4,14|unique:students,mobile',
            'birth_date' => 'required|date|date_format:Y-m-d|before:'.  date('Y-m-d'),
            'university' => 'required',
            'faculty' => 'required',
            'dept' => 'required',
            'know_way' => 'required',
        ];
    }

}

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
class InstructorsValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/instructors/';

    protected function validatCreate() {
        return[
            'name' => 'required|non_special|unique:instructors,name',
            'phone' => 'required|digits_between:4,14|unique:instructors,phone',
            'address' => 'required',
            'email' => 'required|unique:instructors,email',
            'company' => 'required',
        ];
    }

    protected function validatEdit() {

        return[
            'name' => 'required|non_special|unique:instructors,name,' . $this->get('id'),
            'phone' => 'required|digits_between:4,14|unique:instructors,phone,' . $this->get('id'),
            'address' => 'required',
            'email' => 'required|unique:instructors,email,' . $this->get('id'),
            'company' => 'required',
        ];
    }

    public static function getRules() {
        $id = NULL;
        if (!empty(request()->get('phone'))) {
            $id = \App\Models\Instructor::getIDFromPhoneNumber(request()->get('phone'));
        }

        if (!is_null($id)) {
            return[
                'name' => 'required|non_special|unique:instructors,name,' . $id,
                'phone' => 'required|digits_between:4,14|unique:instructors,phone,' . $id,
                'address' => 'required',
                'email' => 'required|unique:instructors,email,' . $id,
                'company' => 'required',
            ];
        }
        else {
            return[
                'name' => 'required|non_special|unique:instructors,name',
                'phone' => 'required|digits_between:4,14|unique:instructors,phone',
                'address' => 'required',
                'email' => 'required|unique:instructors,email',
                'company' => 'required',
            ];
        }
    }
}
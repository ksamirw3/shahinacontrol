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
class GroupesValidator extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/groups/';

    public function rules() {

        return parent::rules();
    }

    protected function validatCreate() {
        return[
            'name' => 'required|non_special|unique:groups,name',
            'diploma_id' => 'required',
            'lab_id' => 'required',
            'start_date' => 'required|date|date_format:Y-m-d|after:'.  date('Y-m-d'),
            'days_of_sessions' => 'required',
            'start_time' => 'required||date_format:H:i',
            'session_duration' => 'required|numeric|min:1',
        ];
    }

    protected function validatEdit() {
        return['name' => 'required|non_special|unique:groups,name,' . $this->get('id'),
            
        ];
    }

    public function validatDates() {
        $day = date('w', strtotime($this->get('start_date')));
//        dd($day, $this->get('days_of_sessions'), $this->get('start_date'));
        if (in_array($day, $this->get('days_of_sessions')))
            return true;
        return false;
    }

//put your code here
}

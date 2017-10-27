<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Validations\Admin;

/**
 * Description of PromotionValidation
 *
 * @author JooAziz
 */
class PromotionValidation extends \App\Http\Validations\BaseValidation {

    protected $myUrl = 'admin/promotions/';

    protected function validatCreate() {
        return [
            "code" => 'required|unique:promotions,code',
            'amount' => 'required|numeric',
            'expire_date' => 'required|date',
        ];
    }

    protected function validatEdit() {
        return [
            "code" => 'required|unique:promotions,code',
            'amount' => 'required|numeric',
            'expire_date' => 'required|date',
        ];
    }

//put your code here
}

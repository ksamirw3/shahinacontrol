<?php

namespace App\Http\Controllers\Api\Client\Wallets;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/client/wallet/';

    public function rules() {
        if ($this->is('add-credit')) {
            return self::addCredit();
        }

        return [];
    }

    private static function addCredit() {
       
        return[
            'promotion' => 'required',
            'user_id' => 'required',
        ];
    }

}

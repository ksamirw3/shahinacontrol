<?php

namespace App\Http\Controllers\Api\Client\Transactions;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/client/transactions/';

    public function rules() {
        if ($this->is('create')) {
            return self::createTransaction();
        } 
        return [];
    }

    private static function createTransaction() {
        return [
        'driver_id' => 'required',
        'client_id' => 'required',
        'order_id' => 'required',
        'amount' => 'required',
        'payment_method' => 'required',
        'date' => 'required|date',
        'description' => 'required',
        ];
    }

}

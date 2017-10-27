<?php

namespace App\Http\Controllers\Api\Driver\Transactions;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/driver/transactions/';

    public function rules() {
        if ($this->is('profit')) {
            return self::viewProfit();
        }
        return [];
    }



    private static function viewProfit() {
        return [
            'driver_id' => 'required|exists:drivers,id',
        ];
    }

    private static function byDriverId() {
        return [
            'driver_id' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ];
    }

}

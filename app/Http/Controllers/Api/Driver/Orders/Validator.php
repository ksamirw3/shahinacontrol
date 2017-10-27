<?php

namespace App\Http\Controllers\Api\Driver\Orders;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/driver/orders/';

    public function rules() {
        if ($this->is('open')) {
            return self::userId();
        } elseif ($this->is('executed')) {

        } elseif ($this->is('rejected')) {
        }
        return [];
    }

    private static function userId() {
        return ['driver_id' => 'required'];
    }

}

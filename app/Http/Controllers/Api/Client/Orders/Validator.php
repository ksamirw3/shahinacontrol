<?php

namespace App\Http\Controllers\Api\Client\Orders;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/client/orders/';

    public function rules() {
        if ($this->is('open')) {
            return self::userId();
        } elseif ($this->is('executed')) {
            return self::userId();
        } elseif ($this->is('rejected')) {
            return self::userId();
        }
        elseif ($this->is('create-order')) {
            return self::createOrder();
        }
        return [];
    }

    private static function userId() {
        return ['user_id' => 'required'];
    }


    private static function createOrder()
    {
        return [
            'car_type'=> 'required',    
        'client_id' => 'required',
        'driver_id' => 'required',
        'description' => 'required',
        'amount' => 'required|min:500',
        'receiver_phone' => 'required|digits_between:4,14',
        'receiver_name' => 'required',
        'from_latitude' => 'required',
        'from_longitude' => 'required',
        'from_address' => 'required',
        'to_latitude' => 'required',
        'to_longitude' => 'required',
        'to_address' => 'required',
        ];
    }

}

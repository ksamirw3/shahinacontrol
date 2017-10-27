<?php

namespace App\Http\Controllers\Api\Client\Reviews;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/client/reviews/';

    public function rules() {
         if ($this->is('create-review')) {
            return self::createReview();
        }

        return [];
    }

    public static function createReview()
    {
        return [
            'user_id' => 'required',
            'driver_id' => 'required',
            'rate' => 'required|integer',
        ];
    }
}
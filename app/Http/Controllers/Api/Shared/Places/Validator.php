<?php

namespace App\Http\Controllers\Api\Shared\Place;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

    protected $url = 'api/driver/users/';

    public function rules() {

        return [];
    }

}

//?username = df&password = 123456789&longitude = 55&latitude = 23
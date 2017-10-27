<?php

namespace App\Http\Controllers\Api;

use JooAziz\Misc\Errors;
use JooAziz\Response\Response as RS;

abstract class BaseValidator {

    protected $url;
    protected $request;

    abstract function rules();

    public function __construct() {
        $this->request = request();
        $require_validator = \Validator::make(request()->all(), $this->rules());
        if ($require_validator->fails()) {
            return RS::make()
                            ->setData($require_validator->errors())
                            ->setMessage('invalid inputs ,please try again ')
                            ->setError(Errors::invalidValidation)
                            ->setResult(FALSE)
                            ->send();
        }
    }

    public function is($key) {
        if (is_null($this->url))
            return RS::custom(RS::make([], FALSE, 'internal error conact with developer'), 500);
        return $this->request->is($this->url . $key);
    }

}

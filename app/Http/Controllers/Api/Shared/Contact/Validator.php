<?php

namespace App\Http\Controllers\Api\Shared\Contact;

class Validator extends \App\Http\Controllers\Api\BaseValidator {

	protected $url = 'api/shared/contact/';

	public function rules() {
		if ($this->is('contact')) {
			return self::contact();
		}
		return [];
	}

	private static function contact()
	{
		return [
		'message' => 'required',
		'driver_id' => 'required',
		'client_id' => 'required',
		];
	}
}

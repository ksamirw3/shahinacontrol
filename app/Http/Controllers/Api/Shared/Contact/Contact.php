<?php

namespace App\Http\Controllers\Api\Shared\Contact;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Place
 *
 * @author Mahmoud Ali
 */
use App\Models\Contact as Model;
use App\Http\Controllers\Api\Shared\Contact\Validator as Checker;
use JooAziz\Response\Response;


class Contact extends \App\Http\Controllers\Api\Base {

	public function anyContact(Checker $d)
	{
		$row = new Model;

		$row->message = request()->message;
		$row->client_id = request()->client_id;
		$row->driver_id = request()->driver_id;
		$row->save();

		return Response::make()->setResult(true)->setMessage(__('admin.transaction created successfully'))->send();
	}
}
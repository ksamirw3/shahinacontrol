<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of Groupe
 *
 * @author Mahmoud Ali
 */
class Transaction extends BaseModel {

	public static $cash = 0;
	public static $visa = 1;
	public static $paid = 2;

	public function client() {
		return $this->belongsTo(User::class, 'client_id');
	}

	public function driver() {
		return $this->belongsTo(Driver::class, 'driver_id');
	}

	public function order() {
		return $this->belongsTo(Order::class, 'order_id');
	}

}

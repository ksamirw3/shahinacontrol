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
 * @author jooaziz
 */
class Driver extends BaseModel {

	public static $small = 1;
	public static $medium = 2;
	public static $large = 3;

	public function orders() {
		return $this->hasMany(Order::class, 'client_id');
	}

	public function transactions() 
	{
		return $this->hasMany(Transaction::class);
	}
	
	public function myTransactions($status)
	{
		if(!is_array($status))
			$status = [$status];

		return $this->transactions()->whereIn('payment_method', $status);
	}

}

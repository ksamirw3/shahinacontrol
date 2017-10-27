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
class Review extends BaseModel {
	
	public function user(){
		return $this->belongTo(User::class);
	}

	public function client() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function driver() {
		return $this->belongsTo(Driver::class, 'driver_id');
	}
}

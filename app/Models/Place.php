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
class Place extends BaseModel {

	public function category() {
		return $this->belongsTo(Category::class, 'category_id');
	}
	
}

<?php

namespace App\Http\Validations\Admin;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Mahmoud
 */
class PlacesValidation extends \App\Http\Validations\BaseValidation {

	protected $myUrl = 'admin/places/';

	public function rules() {
		if ($this->is($this->myUrl . 'edit/*')) {
			return $this->validatEdit();
		}else if ($this->is($this->myUrl . 'create')) {
			return $this->validatCreate();
		}
		return [];
	}

	protected function validatCreate() {
		return ['name_en' => 'required', 'name_ar' => 'required'];
	}

	protected function validatEdit() {
		return ['name_en' => 'required', 'name_ar' => 'required'];
	}
}

<?php

namespace App\Http\Controllers\Api\Shared\Places;

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
use App\Models\Place as Model;
use App\Http\Controllers\Api\Shared\Places\Validator as Checker;


class Places extends \App\Http\Controllers\Api\Base {

    public function anyPlaces()
    {
    	$row = new Model;
    	//$row = $row->all();

    	if(request()->category_id)
            $row = $row->where('category_id','=',request()->category_id);

        return response()->json(['result' => true, "data" => $row->get(), 'message' => __('admin.Function successfull')]);
    }
}